<?php

namespace App\Controller\Admin;

use App\Entity\Lieu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LieuCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Lieu::class;
    }


    public function configureFields(string $pageName): iterable
    {

        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            IntegerField::new('capacite'),
            TextField::new('adresse'),
            TextField::new('iframe'),
            TextField::new('description'),
            ImageField::new('image1', 'Image 1 du lieu')->setBasePath('uploads/')->setUploadDir('public/uploads/'),
            ImageField::new('image2', 'Image 2 du lieu')->setBasePath('uploads/')->setUploadDir('public/uploads/'),
            ImageField::new('image3', 'Image 3 du lieu')->setBasePath('uploads/')->setUploadDir('public/uploads/'),
        ];
    }
}
