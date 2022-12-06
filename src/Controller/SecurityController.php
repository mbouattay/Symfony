<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/register', name: 'register',  methods: ['GET', 'POST'])]
    public function register(Client $client=null,Request $request,EntityManagerInterface $manager,AuthenticationUtils $authenticationUtils): Response
    {
        $client = new Client();
        $form = $this->createForm(RegisterType::class, $client); 
        $form->handleRequest($request);
        return $this->render('security/register.html.twig', [
            'controller_name' => 'SecurityController',
            'form'=>$form
        ]);
    }
    #[Route('/login', name: 'login')]
    public function login(): Response
    {
        return $this->render('security/login.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }
    
}
