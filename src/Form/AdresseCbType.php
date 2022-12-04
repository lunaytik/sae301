<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdresseCbType extends AbstractType
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
                'label' => 'Adresse',
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
            ->add('cardNum', TelType::class, [
                "label" => "Numéro de la carte",
                "attr" => [
                    "placeholder" => "0000 0000 0000 0000"
                ],
                "mapped" => false
            ])
            ->add('cardSec', TelType::class, [
                "label" => "Code de sécurité",
                "attr" => [
                    "placeholder" => "123"
                ],
                "mapped" => false
            ])
            ->add('cardName', TelType::class, [
                "label" => "Nom sur la carte",
                "attr" => [
                    "placeholder" => "John Doe"
                ],
                "mapped" => false
            ])
            ->add('cardMois', ChoiceType::class, [
                "label" => "Mois",
                "attr" => [
                    "placeholder" => "John Doe"
                ],
                "mapped" => false,
                'choices' => [
                    '01' => '01',
                    '02' => '02',
                    '03' => '03',
                    '04' => '04',
                    '05' => '05',
                    '06' => '06',
                    '07' => '07',
                    '08' => '08',
                    '09' => '09',
                    '10' => '10',
                    '11' => '11',
                    '12' => '12',
                ]
            ])
            ->add('cardAnnee', ChoiceType::class, [
                "label" => "Année",
                "choices" => [
                    '2023' => '23',
                    '2024' => '24',
                    '2025' => '25',
                    '2026' => '26',
                    '2027' => '27',
                    '2028' => '28',
                    '2029' => '29',
                    '2030' => '30',
                    '2031' => '31',
                    '2032' => '32',
                    '2033' => '33',
                    '2034' => '34',
                    '2035' => '35',
                    '2036' => '36',

                ],
                "mapped" => false
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
