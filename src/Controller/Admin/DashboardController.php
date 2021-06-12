<?php

namespace App\Controller\Admin;

use App\Entity\Categories;
use App\Entity\Families;
use App\Entity\Orders;
use App\Entity\Plants;
use App\Entity\Prices;
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
        // redirect to some CRUD controller
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(PlantsCrudController::class)->generateUrl());

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<img style="margin-right:20px;" src="../../../resources/images/logo-herborist.svg"> De Herborist')
            ->setFaviconPath("../../../resources/images/logo-herborist.svg");
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Herbarium');
        yield MenuItem::linkToCrud('Plants', 'fab fa-pagelines', Plants::class);
        yield MenuItem::linkToCrud('Families', 'fab fa-pagelines', Families::class);
        yield MenuItem::linkToCrud('Qualities', 'fas fa-mortar-pestle', Qualities::class);
        yield MenuItem::section('Webshop');
        yield MenuItem::linkToCrud('Categories', 'far fa-copy', Categories::class);
        yield MenuItem::linkToCrud('Products', 'fas fa-palette', Products::class);
        yield MenuItem::linkToCrud('Prices', 'fas fa-euro-sign', Prices::class);
        yield MenuItem::linkToCrud('Orders', 'fas fa-boxes', Orders::class)->setDefaultSort(['order_date' => 'DESC']);
        yield MenuItem::linkToCrud('Customers', 'fas fa-user', User::class);
    }
}
