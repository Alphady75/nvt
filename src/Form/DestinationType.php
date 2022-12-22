<?php

namespace App\Form;

use App\Entity\Destination;
use App\Entity\Itineraire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class DestinationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('adresseChargement', TextType::class, [
                'label' => 'Adresse de chargement',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ])
                ],
            ])
            ->add('dateChargement', DateTimeType::class, [
                'label'     =>  'Date de chargement*',
                'widget' => 'single_text',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ])
                ],
            ])
            ->add('adresseLivraison', EntityType::class, [
                'label'     =>  "Adresse de livraison",
                'placeholder'     =>  '--Sélectionnez une adresse--',
                'class' => Itineraire::class,
                'autocomplete' => true,
                'attr' => ['class' => "p-0 m-0 h-25"],
                'expanded' => false,
                'multiple' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ])
                ],
            ])
            ->add('dateLivraison', DateTimeType::class, [
                'label'     =>  'Date de livraison*',
                'widget' => 'single_text',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ])
                ],
            ])
            ->add('lienMap', TextType::class, [
                'label' => 'Itineraire',
                'attr' => ['placeholder' => 'https://goo.gl/maps/JgSctSVYnBy3XkAi9'],
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Destination::class,
        ]);
    }
}
