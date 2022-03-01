<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Form\Builder\Contact;
use App\Repository\UserProfileRepository;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'message'=> 'welcome',
        ]);
    }
   
    #[Route('/contact', name: 'home_contact')]
    public function contact(Request $request,MailerInterface $mailer): Response
    {
         $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = new TemplatedEmail();
            $email->to(new Address("rogervincentluce@gmail.com", "Contact App"))
                ->from($contact->getEmail())
                ->subject($contact->getSubject())                
                ->htmlTemplate('email/contact.html.twig')
                ->context([
                    "message" => $contact->getMessage(),
                ]);
            $mailer->send($email);
            $this->addFlash("success", "your message has been sent");
            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('home/contact.html.twig', [
            'contact' => $contact,
            'form' => $form,
        ]);
    }

}
    


