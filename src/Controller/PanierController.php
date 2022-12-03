<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Evenement;
use App\Entity\LigneReservation;
use App\Entity\Reservation;
use App\Form\AdresseCbType;
use App\Form\CbType;
use App\Repository\ClientRepository;
use App\Repository\EvenementRepository;
use App\Repository\LigneReservationRepository;
use App\Repository\ReservationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'app_panier')]
    public function index(Request $request): Response
    {

        $request->query->get('error') ? $error = 'Panier vide ou erreur lors de la commande ! Veuillez réessayer !' : $error = null;


        return $this->render('panier/panier.html.twig', [
            'controller_name' => 'Lyon\'Tour - Panier',
            'error' => $error
        ]);
    }

    #[Route('/panier/commande', name: 'app_commande')]
    public function commande(Request $request, LigneReservationRepository $ligneReservationRepository, ReservationRepository $reservationRepository,
                             EvenementRepository $evenementRepository, ClientRepository $clientRepository): Response
    {

        $liste = $request->request->get('liste');

        if (empty($liste) || !isset($liste)) {
            return $this->redirectToRoute('app_panier', ['error' => '1']);
        }

        $client = $this->getUser();

        if($request->headers->get('referer') == 'http://localhost:8088/sae301/index.php/panier/commande' || ($client->getAdresse() == null)) {
            $form = $this->createForm(AdresseCbType::class, $client);
        } else {
            $form = $this->createForm(CbType::class, $client);
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $clientRepository->save($client, true);

            $commande = $request->request->get('liste');
            $commande_array = json_decode($commande);

            $user = $this->getUser();
            $now = new \DateTime('now');

            $reservation = new Reservation();
            $reservation->setClient($user);
            $reservation->setDate($now);
            $reservationRepository->save($reservation, true);

            $res_id = $reservation->getId();

            foreach ($commande_array as $event) {
                $evenement = $evenementRepository->find($event->id);
                $res = $reservationRepository->find($res_id);

                $ligne = new LigneReservation();
                $ligne->setEvent($evenement);
                $ligne->setNbPlace($event->quantite);
                $ligne->setReservation($res);
                $ligneReservationRepository->save($ligne, true);

            }

            $request->request->remove('liste');

            return $this->redirectToRoute('app_facture');
        }

        $array = json_decode($liste);
        dump($array);
        return $this->renderForm('panier/commande.html.twig', [
            'controller_name' => 'Lyon\'Tour - Commande',
            'liste' => $array,
            'panier' => $liste,
            'form' => $form
        ]);
    }

    #[Route('/panier/facture', name: 'app_facture')]
    public function facture(Request $request): Response
{
    return $this->render('panier/facture.html.twig', [
        'controller_name' => 'Lyon\'Tour - Facture',
    ]);
}
}

