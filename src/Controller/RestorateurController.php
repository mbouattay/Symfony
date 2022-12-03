<?php

namespace App\Controller;

use App\Entity\Resto;
use App\Form\AddRestoType;
use App\Repository\RestoRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\RestorateurRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RestorateurController extends AbstractController
{
    #[Route('/restorateur', name: 'restorateur')]
    public function index(): Response
    {
        return $this->render('restorateur/index.html.twig', [
            'controller_name' => 'RestorateurController',
        ]);
    }
    #[Route('/reservation', name: 'reservation')]
    public function reservation(): Response
    {
        return $this->render('restorateur/reservation.html.twig', [
            'controller_name' => 'RestorateurController',
        ]);
    }
    #[Route('/add/{id}/resto', name: 'addResto',methods: ['GET', 'POST'])]
    public function addResto(RestorateurRepository $repoR,RestoRepository $repoRs, Resto $resto=null,Request $request,EntityManagerInterface $manager,$id): Response
    {
        $Restorateur = $repoR->find($id) ; 
        $Restos = $repoRs->findAll();
        $resto = new Resto();
        $form = $this->createForm(AddRestoType::class, $resto);    
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $resto->setRestorateur($Restorateur);
            $manager->persist($resto);
            $manager->flush();
           
        }
        return $this->render('restorateur/resto.html.twig', [
            'controller_name' => 'RestorateurController',
            'form' => $form->createView(),
            'Restos'=>$Restos ,
            
        ]);
    }
    #[Route('/{id}/editResto', name: 'Resto_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Resto $resto, RestoRepository $RestoRepository,$id): Response
    {
        $Restos = $RestoRepository->findAll();
        $form = $this->createForm(AddRestoType::class, $resto); 
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $RestoRepository->save($resto, true);
        }

        return $this->renderForm('restorateur/modifie.html.twig', [
            'Restos' => $Restos,
            'form' => $form,
        ]);
    }
}
