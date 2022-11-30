<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'app_panier')]
    public function index(): Response
    {
        return $this->render('panier/panier.html.twig', [
            'controller_name' => 'Lyon\'Tour - Panier',
        ]);
    }

    #[Route('/panier/commande', name: 'app_commande')]
    public function commande(Request $request): Response
    {

        $liste = $request->request->get('liste');

        $array = json_decode($liste);

        return $this->render('panier/commande.html.twig', [
            'controller_name' => 'Lyon\'Tour - Commande',
            'liste' => $array
        ]);
    }
}
