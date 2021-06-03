<?php

namespace App\Controller\Admin;

use App\Entity\Prices;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class PricesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Prices::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            NumberField::new('brutoPrice')->onlyOnIndex()->setTemplatePath('price.html.twig'),
            NumberField::new('nettoPrice')->setTemplatePath('price.html.twig'),
            AssociationField::new('product'),
            DateField::new('date')->onlyOnIndex()
        ];
    }

}
