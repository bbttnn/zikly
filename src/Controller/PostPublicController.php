<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PostPublicController extends AbstractController
{
   #[Route('/post/public', name: 'post_public',methods:['GET'])]
    public function index(PostRepository $postRepository): Response
    {
        $posts=$postRepository->findAll();
        return $this->render('post_public/index.html.twig', [
            'posts' => $posts,
            'controller_name'=>'PostPublicController'
        ]); 
    }
    
    #[Route('/posts/{id}/', name:'post_show', methods:['GET'])] 
    public function show(Post $post): Response
    {
        return $this->render('post_public/post.html.twig', [
            'post' => $post
    
        ]);
    }

    
}

