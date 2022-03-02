<?php

namespace App\Controller;

use App\Repository\UserProfileRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArtistController extends AbstractController
{
    #[Route('/artist', name: 'artist')]
    public function index(UserProfileRepository $userProfileRepo): Response
    {
        return $this->render('artist/index.html.twig', [
            'profiles' => $userProfileRepo->findAll(),
           
        ]);
    }
}
