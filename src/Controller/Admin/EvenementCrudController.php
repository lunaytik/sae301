<?php

namespace App\Controller\Admin;

use App\Entity\Evenement;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EvenementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Evenement::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            TextField::new('realisateur'),
            TextField::new('cast'),
            TextField::new('description'),
            NumberField::new('prix', 'Prix (€)')->setNumDecimals(2),
            DateTimeField::new('date'),
            ImageField::new('affiche')->setBasePath('uploads/')->setUploadDir('public/uploads/'),
            AssociationField::new('lieu', 'Lieu'),
            AssociationField::new('Tag', 'Tag'),
            AssociationField::new('genre', 'Genre')
        ];
    }
}
