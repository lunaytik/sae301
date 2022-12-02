<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Repository\LigneReservationRepository;
use App\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(ReservationRepository $reservationRepository, LigneReservationRepository $ligneReservationRepository): Response
    {
        $reservations = $reservationRepository->findBy(['client'=>$this->getUser()]);


        return $this->render('profil/profil.html.twig', [
            'controller_name' => 'Lyon\'Tour - Profil',
            'reservations' => $reservations,
        ]);
    }

    #[Route('/profil/commande/{id}', name: 'app_commande_detail')]
    public function profil_cmd(Reservation $reservation): Response
    {
        return $this->render('profil/commande_detail.html.twig', [
            'controller_name' => 'Lyon\'Tour - Profil',
            'reservation' => $reservation,
        ]);
    }
}
