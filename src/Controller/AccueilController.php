<?php

namespace App\Controller;

use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(TagRepository $tagRepository): Response
    {

        return $this->render('accueil/accueil.html.twig', [
            'controller_name' => 'Site - Accueil',
            'coups' => $tagRepository->findBy(['nom' => 'Coup de coeur'])
        ]);
    }
}
