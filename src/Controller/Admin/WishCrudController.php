<?php

namespace App\Controller\Admin;

use App\Entity\Wish;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class WishCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Wish::class;
    }


    /*    public function configureFields(string $pageName): iterable
        {
            return [
                TextField::new('title'),
                TextEditorField::new('description'),
                TextField::new('author'),

            ];
        }*/

}
