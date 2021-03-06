<?php

namespace App\Controller\Admin;

use App\Entity\Address;
use App\Entity\Categories;
use App\Entity\Families;
use App\Entity\Orders;
use App\Entity\Plants;
use App\Entity\Products;
use App\Entity\Qualities;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/", name="admin")
     */
    public function index(): Response
    {
        // De homepage van het adminpaneel komt uit op de plants crud controller.
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(PlantsCrudController::class)->generateUrl());

    }

    public function configureDashboard(): Dashboard
    {
        //styling met logo, aangepaste titel en favicon.
        return Dashboard::new()
            ->setTitle('<img style="margin-right:20px;" src="resources/logo-herborist.svg"> De Herborist')
            ->setFaviconPath('resources/logo-herborist.svg');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Herbarium');
        yield MenuItem::linkToCrud('Plants', 'fab fa-pagelines', Plants::class);
        yield MenuItem::linkToCrud('Families', 'fab fa-pagelines', Families::class);
        yield MenuItem::linkToCrud('Qualities', 'fas fa-mortar-pestle', Qualities::class);
        //Onderscheid maken tussen verschillende onderdelen van het admin paneel. Onderstaande delen zijn enkel toegankelijk voor een SUPER_ADMIN
        yield MenuItem::section('Webshop');
        yield MenuItem::linkToCrud('Categories', 'far fa-copy', Categories::class)->setPermission("ROLE_SUPER_ADMIN");
        yield MenuItem::linkToCrud('Products', 'fas fa-palette', Products::class)->setPermission("ROLE_SUPER_ADMIN");
        yield MenuItem::linkToCrud('Orders', 'fas fa-boxes', Orders::class)->setDefaultSort(['order_date' => 'DESC'])->setPermission("ROLE_SUPER_ADMIN");
        yield MenuItem::linkToCrud('Address', 'fas fa-map-marked-alt', Address::class)->setPermission("ROLE_SUPER_ADMIN");
        //Onderdeel ook enkel toegankelijk voor SUPER_ADMIN
        yield MenuItem::section('Users');
        yield MenuItem::linkToCrud('Admin users', 'fas fa-user', User::class)->setPermission("ROLE_SUPER_ADMIN");
    }
}
