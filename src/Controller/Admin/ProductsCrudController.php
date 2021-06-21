<?php

namespace App\Controller\Admin;

use App\Entity\Products;
use App\Form\PriceType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProductsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Products::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $image = ImageField::new('image')->setBasePath('resources/images');
        $imageFile = TextField::new('imageFile')->setFormType(VichImageType::class);
        $fields = [
            IdField::new('id', 'ID')->hideOnForm(),
            TextField::new('name')->formatValue(function ($value){
                return ucfirst($value);
            }),
            TextEditorField::new('description'),
            AssociationField::new('category'),
            AssociationField::new('plants')->setTemplatePath('list.html.twig'),
            NumberField::new('stock')->setTextAlign('right'),
            CollectionField::new('prices', 'bruto price (EUR)')->setEntryType(PriceType::class)->setFormTypeOption('by_reference', false)->setTextAlign('right'),

        ];

        //Op de index pagina en de detailweergave wordt een thumbnail van de image weergegeven.
        if($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL){
            $fields[] = $image;
            // Bij het aanmaken of aanpassen van een fiche wordt het uploadveld weergegeven.
        } else {
            $fields[] = $imageFile;
        }

        return $fields;
    }

    //detail weergave wordt mogelijk gemaakt.
    public function configureActions(Actions $actions): Actions
    {
        return $actions->add(Crud::PAGE_INDEX, 'detail');
    }

}
