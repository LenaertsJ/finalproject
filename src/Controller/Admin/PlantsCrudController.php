<?php

namespace App\Controller\Admin;

use App\Entity\Plants;
use App\Form\ResourceType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PlantsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Plants::class;
    }


    public function configureFields(string $pageName): iterable
    {

        return [
            IdField::new('id', 'ID')->hideOnForm(),
            TextField::new('name'),
            TextField::new('latin_name'),
            TextEditorField::new('symbolism'),
            AssociationField::new('family'),
            AssociationField::new('qualities')
                ->setTemplatePath('list.html.twig'),
            CollectionField::new('images')
                ->setEntryType(ResourceType::class)
                ->setFormTypeOption('by_reference', false)
                ->onlyOnForms(),
            CollectionField::new('images')
                ->setTemplatePath('images.html.twig')
                ->onlyOnDetail()
        ];

    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->add(Crud::PAGE_INDEX, 'detail');
    }

}
