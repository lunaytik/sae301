<?php

namespace App\Controller;

use App\Repository\EvenementRepository;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(EvenementRepository $evenementRepository): Response
    {
        $result = $evenementRepository->findAll(null, 4);
        shuffle($result); // Randomise le résultat
        array_splice($result, 4); // Coupe le tableau pour garder 4 résultats pour l'affichage
        return $this->render('accueil/accueil.html.twig', [
            'controller_name' => 'Lyon\'Tour - Accueil',
            'coups' => $evenementRepository->findBy(['Tag' => 1], null, 4),
            'une' => $evenementRepository->findBy(['Tag' => 2], null, 4),
            'tout' => $result,
            'meta_description' => 'Billeterie en ligne de la ville de Lyon, regroupant les plus grands évenements à découvrir !'
        ]);
    }
}
