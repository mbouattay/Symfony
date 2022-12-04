<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Repository\ReservationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'show_reservation', methods: ['GET'])]
    public function showreservation(ReservationRepository $reservationRepository): Response
    {
        return $this->render('reservation/all.html.twig', [
            'reservations' => $reservationRepository->findAll(),
        ]);
    }
    #[Route('/reservation/valide/{id}', name: 'reservation_valide', methods: ['GET', 'POST'])]
    public function valideRes(Request $request, ReservationRepository $reservationRepository,Reservation $Reservation): Response
    {
        $Reservation->getId();
        $Reservation->setEtat('valide');
        $reservationRepository->save($Reservation, true); 
     
        return $this->redirectToRoute('show_reservation', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/reservation/delete/{id}', name: 'reservation_delete', methods: ['GET', 'POST'])]
    public function deleteRes(Request $request, ReservationRepository $reservationRepository,Reservation $Reservation): Response
    {
        $Reservation->getId();
        $reservationRepository->remove($Reservation, true); 
        return $this->redirectToRoute('show_reservation', [], Response::HTTP_SEE_OTHER);
    }
}
