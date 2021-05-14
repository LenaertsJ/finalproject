<?php

namespace App\Controller\Admin;

use App\Entity\Families;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FamiliesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Families::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
