<?php

namespace App\Controller\Admin;

use App\Entity\Horde;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class HordeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Horde::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            SlugField::new('slug')->setTargetFieldName('name'),
            TextField::new('breed'),
            TextField::new('gender'),
            TextField::new('birth'),  // mettre DateField mais problème dans l'entity convert type string
            TextareaField::new('description'),
            ImageField::new('illustration')
            ->setBasePath('uploads/')
            ->setUploadDir('public/uploads')
            ->setUploadedFileNamePattern('[randomhash].[extension]'),
            BooleanField::new('wonderland'),
        ];
    }
    
}
