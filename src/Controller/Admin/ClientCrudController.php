<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ClientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Client::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('email'),
            TextField::new('password'),
            ChoiceField::new('roles')
                ->setLabel("Roles")
                ->setChoices([
                    'ADMIN' => 'ROLE_ADMIN',
                    'CLIENT' => 'ROLE_USER',
                ])
                ->allowMultipleChoices()
                ->renderExpanded(true),
            TextField::new('nom'),
            TextField::new('prenom'),
            CountryField::new('pays'),
            TextField::new('adresse'),
            TextField::new('cp'),
            TextField::new('ville'),
        ];
    }
}
