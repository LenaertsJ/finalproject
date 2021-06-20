<?php

namespace App\Controller\Admin;

use App\Entity\Orders;
use App\Form\AddressType;
use App\Form\ChoiceType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
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

    public function configureActions(Actions $actions): Actions
    {
        return $actions->disable(Action::DELETE);
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'ID')->onlyOnIndex(),
            ChoiceField::new('status')->setChoices([
                'Processing' => 'Processing',
                'Sent' => 'Sent',
                'Canceled' => 'Canceled'
            ]),
            DateField::new('order_date', 'Date')->onlyOnIndex(),
            NumberField::new('totalPrice', 'Total price')->setTemplatePath('price.html.twig')->onlyOnIndex(),
            NumberField::new('totalItems', 'Total quantity')->onlyOnIndex(),
            AssociationField::new('address', 'Address')->onlyOnIndex(),
            AssociationField::new('orderedProducts')->setTemplatePath('list.html.twig')->onlyOnIndex(),

        ];
    }

}
