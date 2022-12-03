<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Reservation;
use App\Form\AdresseType;
use App\Repository\ClientRepository;
use App\Repository\LigneReservationRepository;
use App\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(Request $request, ClientRepository $clientRepository, ReservationRepository $reservationRepository, LigneReservationRepository $ligneReservationRepository): Response
    {
        $reservations = $reservationRepository->findBy(['client'=>$this->getUser()]);
        $client = $this->getUser();

        $form = $this->createForm(AdresseType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $clientRepository->save($client, true);

            return $this->redirectToRoute('app_profil', ['success' => '1'], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('profil/profil.html.twig', [
            'controller_name' => 'Lyon\'Tour - Profil',
            'client' => $client,
            'form' => $form,
            'reservations' => $reservations
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
