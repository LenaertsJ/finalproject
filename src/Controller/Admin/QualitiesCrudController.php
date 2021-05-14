<?php

namespace App\Controller\Admin;

use App\Entity\Qualities;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class QualitiesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Qualities::class;
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
