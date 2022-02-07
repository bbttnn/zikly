<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\UserProfile;
use App\Form\UserProfileType;
use App\Service\UploadService;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserProfileRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/userProfile')]
#[IsGranted('ROLE_USER')]
class UserProfileController extends AbstractController
{


    #[Route('/', name: 'userProfile_index', methods: ['GET'])]
    public function index(UserProfileRepository $userProfileRepository): Response
    { 
        $user = $this->getUser();
        return $this->render('userProfile/index.html.twig', [
            'userProfile' => $userProfileRepository->findOneBy([
                'User'=> $user,
            ]),
        ]);
    }

    #[Route('/new', name: 'userProfile_new', methods: ['GET','POST'])]
    public function new(Request $request,UploadService  $uploader, EntityManagerInterface $entityManager): Response
    {
        $userProfile = new UserProfile();
        $form = $this->createForm(UserProfileType::class, $userProfile);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            
            $user = $this->getUser();
            if ($image) {
                $filename= $uploader->upload($image);
                $userProfile->setImage( $filename);
            }
            $userProfile->setUser($user);
        
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userProfile);
            $entityManager->flush();

            return $this->redirectToRoute('userProfile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('userProfile/new.html.twig', [
            'userProfile' => $userProfile,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/show', name: 'userProfile_show', methods: ['GET'])]
    public function show(UserProfile $userProfile): Response
    {
        return $this->render('userProfile/show.html.twig', [
            'userProfile' => $userProfile,
        ]);
    }

 

    #[Route('/{id}/edit', name: 'userProfile_edit', methods: ['GET','POST'])]
    public function edit(Request $request, UserProfile $userProfile,UploadService $uploader): Response
    {
        $form = $this->createForm(UserProfileType::class, $userProfile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imagesFile = $form->get('image')->getData();
            if ($imagesFile) {
               foreach($imagesFile as $imageFile){
                    $oldPath = "";
                    if ($userProfile->getImage()) {
                        $oldPath = $userProfile->getImage();
                    }
                    $file = $uploader->upload($imageFile,$oldPath);
                    $userProfile->setImage($file);
                   $image= new Image;
                   $image->setName($file)
                        ->setUserProfile($userProfile);
                    $this->getdoctrine ()->getManager()->persist($image);
                                           
                }
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('userProfile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('userProfile/edit.html.twig', [
            'userProfile' => $userProfile,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'userProfile_delete', methods: ['POST'])]
    public function delete(Request $request, UserProfile $userProfile,UploadService $uploader, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userProfile->getId(), $request->request->get('_token'))) {
            $uploader->delete($userProfile->getImage());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userProfile);
            $entityManager->flush();
        }

        return $this->redirectToRoute('userProfile_index', [], Response::HTTP_SEE_OTHER);
    }
    
   
    }

