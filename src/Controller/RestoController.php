<?php

namespace App\Controller;

use App\Repository\RestoRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RestoController extends AbstractController
{
    
    #[Route('/restaurant', name: 'Res', methods: ['GET'])]
    public function showResto(RestoRepository $restoRepository): Response
    {
        return $this->render('resto/index.html.twig', [
            'Restos' => $restoRepository->findAll()
        ]);
    }
}
