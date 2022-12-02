<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\LigneReservation;
use App\Entity\Reservation;
use App\Repository\EvenementRepository;
use App\Repository\LigneReservationRepository;
use App\Repository\ReservationRepository;
use Symfony\Component\HttpFoundation\Cookie;
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
    public function commande(Request $request): Response
    {
        $link = $request->headers->get('referer');

        $options = strpos($link, '?');

        if (isset($options) && !empty($options)) {
            $link = substr($link, 0, $options);
        }

        if ($link != 'http://localhost:8088/sae301/index.php/panier') {
            return $this->redirectToRoute('app_panier', ['error' => '2']);
        } else {
            $liste = $request->request->get('liste');

            //dump($request);
            //die();

            if (empty($liste) || !isset($liste)) {
                return $this->redirectToRoute('app_panier', ['error' => '1']);
            } else {
                $array = json_decode($liste);
                dump($array);
                return $this->render('panier/commande.html.twig', [
                    'controller_name' => 'Lyon\'Tour - Commande',
                    'liste' => $array,
                    'panier' => $liste
                ]);
            }
        }
    }


    #[Route('/panier/validation', name: 'app_validation')]
    public function paiement(Request $request, ReservationRepository $reservationRepository,
        LigneReservationRepository $ligneReservationRepository, EvenementRepository $evenementRepository): Response
    {
        $commande = $request->request->get('reservation');
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

        $request->request->remove('reservation');

        return $this->redirectToRoute('app_facture');
    }

    #[Route('/panier/facture', name: 'app_facture')]
    public function facture(Request $request): Response
    {
        return $this->render('panier/facture.html.twig', [
            'controller_name' => 'Lyon\'Tour - Facture',
        ]);
    }
}

