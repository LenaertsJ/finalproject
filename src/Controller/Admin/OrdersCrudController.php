<?php

namespace App\Controller\Admin;

use App\Entity\Orders;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class OrdersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Orders::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'ID'),
            NumberField::new('totalPrice', 'Total price (EUR)'),
            NumberField::new('totalItems', 'Total quantity'),
            DateField::new('order_date', 'Date'),
            AssociationField::new('customer', 'Customer'),
            AssociationField::new('address', 'Address'),
            AssociationField::new('orderedProducts')->setTemplatePath('list.html.twig')
        ];
    }

}
