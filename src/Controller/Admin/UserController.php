<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UserType;
use App\Service\UploadService;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Image;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('admin/user')]
#[IsGranted("ROLE_USER")]


class UserController extends AbstractController
{
    #[Route('/', name: 'admin_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        
        return $this->render('admin/user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_user_new', methods: ['GET','POST'])]
    public function new(Request $request,UserPasswordHasherInterface $userPasswordHasherInterface,
     EntityManagerInterface $entityManager,UploadService  $uploader): Response
    {
        
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile =$form->get('image')->getData();            
            if($imageFile){
                $filename = $uploader->upload($imageFile);
                $user->setImage($filename);
               
            $originalFilename=pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                   //dd($originalFilename) ;                    
            }
                       //dd($imageFile);
            $user->setRoles([]);
             // encode the plain password
             $user->setPassword(
                $userPasswordHasherInterface->hashPassword(
                        $user,
                        $form->get('plainPassword')->getData()
                    )
                );
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('admin_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_user_show', methods: ['GET'])]
    public function show(User $user ): Response
    {
        return $this->render('admin/user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_user_edit', methods: ['GET','POST'])]
    public function edit(Request $request, User $user,UploadService $uploader): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile= $form->get('image')->getData();
            if($imageFile){
                foreach($imageFile as $imageFile){
                   $oldPath = ";";
                   if($user ->getImage()){
                       $oldPath = $user->getImage();
                   }
                   $file = $uploader->upload($imageFile, $oldPath);
                    $user->setImage($file);
                    $image = new Image;
                   /* $image->setName($imageFile)*/
                           /*->setUser($user);*/
                    $this->getDoctrine()->getManager()->persist($image);

                }
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_user_index', [], Response::HTTP_SEE_OTHER);
    }
   

}
