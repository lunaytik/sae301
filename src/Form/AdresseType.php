<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

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
                ],
                new Length([
                    'min' => 5,
                    'minMessage' => 'Le code postal doit contenir {{ limit }} caractères',
                    'max' => 5
                ])
            ])
            ->add('ville', TextType::class, [
                'attr' => [
                    'placeholder' => 'Troyes'
                ],
                new Length([
                    'max' => 40,
                    'maxMessage' => 'La ville doit contenir au maximum {{ limit }} caractères'
                ])
            ])
            ->add('pays', CountryType::class, [
                'data' => 'FR'
            ])
            ->add('telNum', TelType::class, [
                "label" => "Numéro de téléphone",
                "attr" => [
                    "placeholder" => "06 10 50 00 00"
                ],
                new Length([
                    'min' => 10,
                    'minMessage' => 'Le numéro de téléphone doit contenir {{ limit }} caractères',
                    'max' => 14
                ])
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
