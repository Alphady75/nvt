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
            ->add('statut', ChoiceType::class, [
                'label' => "Statut*",
                'choices'  => [
                    'En attente' =>  0,
                    'Commande livrée' =>  1,
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ]),
                ],
            ])
            ->add('itineraires', EntityType::class, [
                'label'     =>  false,
                'placeholder'     =>  '--Sélectionnez un itineraire--',
                'class' => Itineraire::class,
                'autocomplete' => true,
                'attr' => ['class' => "p-0 m-0 h-25"],
                'expanded' => false,
                'multiple' => true,
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
            ->add('ville', EntityType::class, [
                'label'     =>  'Ville*',
                'autocomplete' => true,
                'attr' => ['class' => "p-0 m-0 h-25"],
                'placeholder'     =>  '--Sélectionnez ville--',
                'class' => Ville::class,
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

        $builder->get('ville')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {

                $form = $event->getForm();

                $this->addSecteurFields($form->getParent(), $form->getData());
            }
        );

        $builder->addEventListener(
            FormEvents::POST_SET_DATA,
            function (FormEvent $event) {

                $data = $event->getData();
                /* @var $secteur Secteur */
                $secteur = $data->getSecteur(); //dd(Secteur);

                $form = $event->getForm();

                if ($secteur) {

                    $ville = $secteur->getville();

                    $this->addSecteurFields($form, $ville);

                    $form->get('ville')->setData($ville);
                    $form->get('secteur')->setData($secteur);
                } else {
                    $this->addSecteurFields($form, null);
                }
            }
        );
    }

    /**
     * Rajoute un champ de type SecteurType au formulaire
     * 
     * @param Ville $ville
     * @return void
     */
    private function addSecteurFields($form, ?Ville $ville)
    {

        $builder = $form->getConfig()->getFormFactory()->createNamedBuilder(
            'secteur',
            EntityType::class,
            null,
            [
                'label' => 'Secteur*',
                'class' =>  Secteur::class, 
                'autocomplete' => true,
                'attr' => ['class' => "p-0 m-0"],
                'auto_initialize'   =>  false,
                'placeholder'   =>  $ville ? 'Secteur pour ' . $ville->getName() : '--sélectionnez une ville--',
                'choices'   =>  $ville ? $ville->getSecteurs() : [],
                'choice_label' => 'name',
                'required'  =>  false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ]),
                ],
            ]
        );

        $form->add($builder->getForm());
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}