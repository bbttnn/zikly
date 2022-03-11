<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Service\UploadService;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/post')]
class PostController extends AbstractController
{
    #[Route('/', name: 'post_index', methods: ['GET'])]
    public function index(PostRepository $postRepository): Response
    {
        return $this->render('post/index.html.twig', [
            'posts' => $postRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'post_new', methods: ['GET', 'POST'])]
    public function new(Request $request,UploadService  $uploader, EntityManagerInterface $entityManager): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
           if($image){
               $filename = $uploader->upload($image);
               $post->setImage($filename);
              
           }
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('post/new.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'post_show', methods: ['GET'])]
    public function show(Post $post): Response
    {
        return $this->render('post/show.html.twig', [
            'post' => $post,
        ]);
    }

    #[Route('/{id}/edit', name: 'post_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Post $post,UploadService  $uploader, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();
            if ($imageFile){                
                    $oldpath = "";
                    if($post->getImage()){
                        $oldpath = $post->getImage();
                    }
                    $filename = $uploader->upload($imageFile,$oldpath);
                    $post->setImage($filename);
                   
                        /*$this->getDoctrine()->getManager();*/                             
            }
            /*$entityManager->persist($image);*/
            $entityManager->flush();

            return $this->redirectToRoute('post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('post/edit.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'post_delete', methods: ['POST'])]
    public function delete(Request $request, Post $post,UploadService  $uploader, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post->getId(), $request->request->get('_token'))) {
            $uploader->delete($post->getImage());
            $entityManager->remove($post);
            $entityManager->flush();
        }

        return $this->redirectToRoute('post_index', [], Response::HTTP_SEE_OTHER);
    }
}
