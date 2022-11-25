<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Evenement;
use App\Repository\EvenementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;


class EvenementController extends AbstractController
{
    #[Route('/evenements', name: 'app_evenements')]
    public function index(EvenementRepository $evenementRepository): Response
    {
        return $this->render('evenement/evenements.html.twig', [
            'controller_name' => 'Site - Evenements',
            'evenements' => $evenementRepository->findAll(),
        ]);
    }

    #[Route('/evenements/{genre}/{id}', name: 'app_evenement')]
    public function show(Evenement $evenement): Response
    {
        return $this->render('evenement/evenement.html.twig', [
            'controller_name' => 'Site - Evenement',
            'evenement' => $evenement,
        ]);
    }

}
