<?php

namespace App\Controller;

use App\Entity\UserProfile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShowPublicController extends AbstractController
{
    /*#[Route('/showPublic', name: 'showPublic')]
    public function index(): Response
    {
        return $this->render('showPublic/index.html.twig', [
            'controller_name' => 'ShowPublicController',
        ]);
    }*/
      #[Route('/profile/{id}/public', name: 'userProfile_show_Public', methods: ['GET'])]
    public function showPublic(UserProfile $userProfile): Response
   {
        return $this->render('showPublic/index.html.twig', [
            'profile' => $userProfile,
        ]);
   }
    
}
