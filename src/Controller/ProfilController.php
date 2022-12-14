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
    public function index(Request $request, ClientRepository $clientRepository, ReservationRepository $reservationRepository): Response
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
            'reservations' => $reservations,
            'meta_description' => 'Retrouvez ici, votre profil regroupant vos informations personnelles et votre historique de commandes'
        ]);
    }

    #[Route('/profil/commande/{id}', name: 'app_commande_detail')]
    public function profil_cmd(ReservationRepository $reservationRepository, Request $request): Response
    {

        $reservation = $reservationRepository->find($request->attributes->get('id'));

        if($reservation == null) {
            return $this->redirectToRoute('app_profil', ['commande_error'=>'1']);
        }

        $client_connected_id = $this->getUser()->getId();

        $client_id = $reservation->getClient()->getId();

        if ($client_connected_id != $client_id) {
            return $this->redirectToRoute('app_profil', ['commande_error'=>'1']);
        }

        return $this->render('profil/commande_detail.html.twig', [
            'controller_name' => 'Lyon\'Tour - Profil',
            'reservation' => $reservation,
        ]);
    }
}
