<?php

namespace App\Controller;

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

        $liste = $request->request->get('liste');

        if(empty($liste) && isset($liste) || !isset($liste)) {
            return $this->redirectToRoute('app_panier', ['error' => '1']);
        } else {
            $array = json_decode($liste);
            return $this->render('panier/commande.html.twig', [
                'controller_name' => 'Lyon\'Tour - Commande',
                'liste' => $array
            ]);
        }





    }
}
