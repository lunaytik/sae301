<?php

namespace App\Controller;

use App\Repository\LieuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LieuxController extends AbstractController
{
    #[Route('/lieux', name: 'app_lieux')]
    public function index(LieuRepository $lieuRepository ): Response
    {
        $lieux = $lieuRepository->findAll();
        return $this->render('lieux/lieux.html.twig', [
            'controller_name' => 'LieuxController',
            'lieux' => $lieux
        ]);
    }
}
