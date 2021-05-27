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
        $image = ImageField::new('image')->setBasePath('resources/images');
        $imageFile = TextField::new('imageFile')->setFormType(VichImageType::class);
        $fields = [
            IdField::new('id', 'ID')->hideOnForm(),
            TextField::new('name')->formatValue(function ($value){
                return ucfirst($value);
            }),
            TextField::new('latin_name'),
            TextEditorField::new('symbolism'),
            AssociationField::new('family'),
            AssociationField::new('qualities')->setRequired(true)
                ->setTemplatePath('list.html.twig')
        ];

        if($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL){
            $fields[] = $image;
        } else {
            $fields[] = $imageFile;
        }

        return $fields;

    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->add(Crud::PAGE_INDEX, 'detail');
    }

}
