<?php

namespace App\Controller;

use App\Repository\GenreRepository;
use App\Repository\TagRepository;
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

    #[Route('/evenements/genre/{genre}', name: 'app_evenement_genre')]
    public function showGenre(EvenementRepository $evenementRepository, GenreRepository $genreRepository, string $genre): Response
    {
        $resultat = $genreRepository->findOneBy(['nom' => $genre]);

        return $this->render('evenement/evenements_genre.html.twig', [
            'controller_name' => 'Site - Evenement',
            'evenements' => $evenementRepository->findBy(['genre' => $resultat]),
            'genre' => $genre
        ]);
    }

    #[Route('/evenements/tag/{tag}', name: 'app_evenement_tag')]
    public function showTag(EvenementRepository $evenementRepository, TagRepository $tagRepository, string $tag)
    {
        $tag = str_replace('-', ' ', ucfirst($tag));

        $result = $tagRepository->findOneBy(['nom' => $tag]);

        return $this->render('evenement/evenements_tag.html.twig', [
            'controller_name' => "Site - Evenements $tag",
            'evenements' => $evenementRepository->findBy(['Tag' => $result]),
            'tag' => $tag
        ]);
    }

    #[Route('/evenements/{genre}/{id}', name: 'app_evenement')]
    public function show(Evenement $evenement, EvenementRepository $evenementRepository): Response
    {

        $lieu_id = $evenement->getLieu();

        return $this->render('evenement/evenement.html.twig', [
            'controller_name' => 'Site - Evenement',
            'evenement' => $evenement,
            'suggestions' => $evenementRepository->findBy(['lieu'=>$lieu_id],null,4)
        ]);
    }


}
