<?php

namespace App\Controller;


use DateTime;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'blog',methods:['GET'])]
    public function index(PostRepository $postRepository): Response

    {   
        $posts = $postRepository->findAll();    
        return $this->render('blog/index.html.twig', [
         'posts'=> $posts
            
        ]);
    }
   
     #[Route('/posts/{id}/', name:'post_show', methods:['GET'])] 
    public function show(Post $post): Response
    {
        return $this->render('blog/post.html.twig', [
            'post' => $post
    
        ]);
    }

}
