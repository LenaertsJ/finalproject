<?php

namespace App\Controller\Admin;

use App\Entity\Plants;
use App\Form\ResourceType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
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
//        $imageFile = TextAreaField::new('imageFile')->setFormType(VichImageType::class);
//        $image = ImageField::new('image')->setBasePath('resources/images');
        return [
            TextField::new('name'),
            TextField::new('latin_name'),
            TextEditorField::new('symbolism'),
            AssociationField::new('family'),
            CollectionField::new('images')
                ->setEntryType(ResourceType::class)
                ->setFormTypeOption('by_reference', false)
                ->onlyOnForms(),
            CollectionField::new('images')
                ->setTemplatePath('images.html.twig')
                ->onlyOnDetail()
        ];

//        if ($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL){
//            $fields[] = $image;
//        } else {
//            $fields[] = $imageFile;
//        }

//        return $fields;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->add(Crud::PAGE_INDEX, 'detail');
    }

}
