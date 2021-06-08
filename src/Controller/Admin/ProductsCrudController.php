<?php

namespace App\Controller\Admin;

use App\Entity\Products;
use App\Form\PriceType;
use Doctrine\Common\Collections\ArrayCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
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
            TextField::new('name'),
            TextEditorField::new('description'),
            AssociationField::new('category'),
            AssociationField::new('plants')->setTemplatePath('list.html.twig'),
            NumberField::new('stock'),
            CollectionField::new('prices')->setEntryType(PriceType::class)->setFormTypeOption('by_reference', false),
            AssociationField::new('prices', 'bruto price')->onlyOnIndex()->setTemplatePath('price.html.twig'),

        ];

        if($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL){
            $fields[] = $image;
        } else {
            $fields[] = $imageFile;
        }

        return $fields;
    }

}
