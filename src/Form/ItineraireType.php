<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Itineraire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Url;

class ItineraireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('designation', TextType::class, [
                'label' => 'Désination*',
                'attr' => ['placeholder' => "Indiquez la désignation de l'itineraire*"],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ]),
                ],
            ])
            ->add('adresse', TextType::class, [
                'label' => 'Adresse*',
                'attr' => ['placeholder' => "Indiquez l'adresse de livraison*"],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ]),
                ],
            ])
            ->add('client', EntityType::class, [
                'help'     =>  'Facultatif',
                'label'     =>  'Client',
                //'attr' => ['class' => "p-0 m-0 h-25"],
                'placeholder'     =>  '--Sélectionnez un client--',
                'class' => Client::class,
                'required' => false,
            ])
            ->add('tarif', NumberType::class, [
                'label' => 'Tarif*',
                'attr' => ['placeholder' => '€'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ]),
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => ['placeholder' => "Indiquez une description"],
                'attr' => ['rows' => "6"],
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Itineraire::class,
        ]);
    }
}
