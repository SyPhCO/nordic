<?php

namespace App\Controller\Admin;

use App\Entity\Header;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class HeaderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Header::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', 'Titre du header ( titre du caroussel )'),
            TextareaField::new('content', 'Contenu du Header ( contenu texte du caroussel )'),
            TextField::new('btnTitle', 'Titre du bouton ( intérieur du bouton )'),
            TextField::new('btnUrl', 'Liens vers lequel renvoie le bouton ( Url de destination )'),
            ImageField::new('illustration')
            ->setBasePath('uploads/')
            ->setUploadDir('public/uploads')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(false)
        ];
    }

}
