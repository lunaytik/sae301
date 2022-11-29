<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use App\Entity\Evenement;
use App\Entity\Lieu;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('SAE301 - Admin Panel');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Les évenements', 'fas fa-list', Evenement::class);
        yield MenuItem::linkToCrud('Les lieux', 'fas fa-globe', Lieu::class);
        yield MenuItem::linkToCrud('Les clients', 'fas fa-user', Client::class);

    }
}
