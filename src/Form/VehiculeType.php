<?php

namespace App\Form;

use App\Entity\Vehicule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Vich\UploaderBundle\Form\Type\VichImageType;

class VehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imageFile', VichImageType::class, [
                'label' => '(png, jpg et jpeg)',
                'required'  =>  false,
                'allow_delete' =>  false,
                'download_label'     =>  false,
                'image_uri'     =>  false,
                'download_uri'     =>  false,
                'imagine_pattern'   =>  'medium_size',
            ])
            ->add('name', TextType::class, [
                'label' => "Désignation*",
                'attr' => ['placeholder' => "Désignation*"],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ]),
                ],
            ])
            ->add('numero', TextType::class, [
                'label' => "Matricule",
                'attr' => ['placeholder' => "Matricule"],
                'required' => false,
            ])
            ->add('description', TextareaType::class, [
                'label' => "Description",
                'attr' => ['placeholder' => "Désignation", 'rows' => 6],
                'required' => false
            ])
            ->add('reference', TextType::class, [
                'label' => "Référence",
                'attr' => ['placeholder' => "Référence*"],
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicule::class,
        ]);
    }
}
