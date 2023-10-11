<?php

namespace App\Controller\Admin;

use App\Entity\Company;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CompanyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Company::class;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('adress'),
            IntegerField::new('rating'),
            BooleanField::new('IsHot'),
            IntegerField::new('hotRating'),
            TextareaField::new('description'),
            ImageField::new('picture')
                ->setBasePath('uploads/picture')
                ->setUploadDir('public/uploads/picture'),
        ];
    }

}
