<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                "label" => "Nom",
                "attr" => [
                    "placeholder" => "Doe"
                ]
            ])
            ->add('prenom', TextType::class, [
                "label" => "Prénom",
                "attr" => [
                    "placeholder" => "John"
                ]
            ])
            ->add('adresse', TextType::class, [
                'attr' => [
                    'placeholder' => '9 rue de Québec'
                ]
            ])
            ->add('cp', TelType::class, [
                "label" => "Code postal",
                'attr' => [
                    'placeholder' => '10000'
                ]
            ])
            ->add('ville', TextType::class, [
                'attr' => [
                    'placeholder' => 'Troyes'
                ]
            ])
            ->add('pays', CountryType::class, [
                'data' => 'FR'
            ])
            ->add('telNum', TelType::class, [
                "label" => "Numéro de téléphone",
                "attr" => [
                    "placeholder" => "06 10 50 00 00"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
