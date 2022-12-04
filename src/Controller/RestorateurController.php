<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Entity\Resto;
use App\Form\AddmenuType;
use App\Form\AddRestoType;
use App\Repository\MenuRepository;
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

    #[Route('/menus', name: 'showmenu', methods: ['GET'])]
    public function showMenu(MenuRepository $MenuRepository): Response
    {
        return $this->render('restorateur/menus.html.twig', [
            'menus' => $MenuRepository->findAll(),
        ]);
    }
   
    #[Route('/{id}/editemenu', name: 'menu_edit', methods: ['GET', 'POST'])]
    public function editemnu(Request $request, Menu $menu, MenuRepository $MenuRepository,$id): Response
    {
        $menus = $MenuRepository->findAll();
        $form = $this->createForm(AddmenuType::class, $menu); 
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $MenuRepository->save($menu, true);
        }

        return $this->renderForm('restorateur/modifiemenu.html.twig', [
            'menus' => $menus,
            'form' => $form,
        ]);
    }

    #[Route('/restorateur', name: 'restorateur')]
    public function index(): Response
    {
        return $this->render('restorateur/index.html.twig', [
            'controller_name' => 'RestorateurController',
        ]);
    }
    #[Route('/addmenu', name: 'addmenu')]
    public function addmenu(MenuRepository $Rmenu, Menu $menu=null,Request $request,EntityManagerInterface $manager): Response
    {
        $menus = $Rmenu->findAll();
        $menu = new Menu();
        $form = $this->createForm(AddmenuType::class, $menu); 
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($menu);
            $manager->flush();
           
        }
        return $this->render('restorateur/addmenu.html.twig', [
            'controller_name' => 'RestorateurController',
            'form' => $form->createView(),
            'menus'=>$menus
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
        return $this->render('restorateur/addresto.html.twig', [
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
    #[Route('/{id}/Resto', name: 'showResto', methods: ['GET'])]
    public function showResto(RestoRepository $restoRepository,$id): Response
    {
        return $this->render('restorateur/restos.html.twig', [
            'Restos' => $restoRepository->findAll(),
            'id'=>$id
        ]);
    }
    #[Route('/{id}', name: 'deleteResto')]
    public function delete(Request $request, Resto $resto, RestoRepository $restoRepository): Response
    {
        $resto->getId();
        $restoRepository->remove($resto, true); 
     
          return $this->redirectToRoute('restorateur', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/deletemenu/{id}', name: 'deletemenu')]
    public function deletemenu(Request $request, MenuRepository $menuRepository,Menu $menu): Response
    {
        $menu->getId();
        $menuRepository->remove($menu, true); 
     
        return $this->redirectToRoute('showmenu', [], Response::HTTP_SEE_OTHER);
    }
   

}
