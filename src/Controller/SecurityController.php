<?php

namespace App\Controller;

use App\Entity\Client;
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
        if($_POST['nom']!='' && $_POST['prenom']!=''
            && $_POST['email']!='' && $_POST['telephone']!=''
            && $_POST['password'] == $_POST['confirm_password']
            ){
                $data=new Client;
                $data->setNom($_POST['nom']);
                $data->setPrenom($_POST['prenom'])
                    ->setEmail($_POST['email'])    
                    ->setPassword($_POST['password'])
                    ->setTel($_POST['telephone'])
                    ->setRole("client");
                $em->persist($data);  
                $em->flush();

                // Apres inscription
                $_POST = array();
                unset($data);
                
                return $this->redirectToRoute('/');

            }else{
                echo('
                <script>
                    alert("Revoyez votre saisie ! ");
                </script>
                ');
                $_POST = array();
            }

        return $this->render('security/register.html.twig', [
            'controller_name' => 'SecurityController',
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
