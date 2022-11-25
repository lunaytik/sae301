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
        return $this->render('accueil/accueil.html.twig', [
            'controller_name' => 'Site - Accueil',
            'coups' => $evenementRepository->findBy(['Tag' => 1], null, 4),
            'une' => $evenementRepository->findBy(['Tag' => 2], null, 4)
        ]);
    }
}
