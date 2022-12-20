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
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ]),
                ],
            ])
            ->add('link', UrlType::class, [
                'label' => 'Lien*',
                'attr' => ['placeholder' => 'https://goo.gl/maps/JgSctSVYnBy3XkAi9'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ]),
                    new Url([
                        'message' => 'Veuillez indiquer une URL valide, sans oublier le http:// soit le https://',
                    ]),
                ],
            ])
            ->add('client', EntityType::class, [
                'help'     =>  'Facultatif',
                'label'     =>  'Client',
                //'attr' => ['class' => "p-0 m-0 h-25"],
                'placeholder'     =>  '--Sélectionnez client--',
                'class' => Client::class,
                //'autocomplete' => true,
            ])
            ->add('tarif', NumberType::class, [
                'label' => 'Tarif*',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ]),
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => ['rows' => "6"],
                'required' => 'false'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Itineraire::class,
        ]);
    }
}