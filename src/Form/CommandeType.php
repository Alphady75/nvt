<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Commande;
use App\Entity\Conducteur;
use App\Entity\Itineraire;
use App\Entity\Secteur;
use App\Entity\Vehicule;
use App\Entity\Ville;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('itineraire', EntityType::class, [
                'label'     =>  false,
                'placeholder'     =>  '--Sélectionnez un itineraire--',
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
            ->add('dateReception', DateType::class, [
                'label'     =>  'Date de reception*',
                'widget' => 'single_text',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ])
                ],
            ])
            ->add('dateLivraison', DateType::class, [
                'label'     =>  'Date de livraison*',
                'widget' => 'single_text',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ])
                ],
            ])
            ->add('client', EntityType::class, [
                'help'     =>  'Client*',
                'label'     =>  false,
                'autocomplete' => true,
                'attr' => ['class' => "p-0 m-0 h-25"],
                'placeholder'     =>  '--Sélectionnez client--',
                'class' => Client::class,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ])
                ],
            ])
            ->add('vehicule', EntityType::class, [
                'label'     =>  'Vehicule*',
                'autocomplete' => true,
                'attr' => ['class' => "p-0 m-0 h-25"],
                'placeholder'     =>  '--Sélectionnez vehicule--',
                'class' => Vehicule::class,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ])
                ],
            ])
            ->add('conducteur', EntityType::class, [
                'class' => Conducteur::class,
                'label'     =>  'Conducteur*',
                'autocomplete' => true,
                'attr' => ['class' => "p-0 m-0 h-25"],
                'placeholder'     =>  '--Sélectionnez conducteur--',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ])
                ],
            ])
            ->add('observation', TextareaType::class, [
                'label'     =>  false,
                'help' =>  'Facultatif',
                'attr' =>  ['rows' => 8, 'placeholder'     =>  'Observation'],
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
