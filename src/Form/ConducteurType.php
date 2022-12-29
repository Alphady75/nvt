<?php

namespace App\Form;

use App\Entity\Conducteur;
use App\Entity\Ville;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ConducteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code', TextType::class, [
                'label' => "Code*",
                'required' => false,
                'attr' => ['placeholder' => "Code*"],
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ]),
                ],
            ])
            ->add('nom', TextType::class, [
                'label' => "Nom*",
                'attr' => ['placeholder' => "nom*"],
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ]),
                ],
            ])
            ->add('prenom', TextType::class, [
                'label' => "Prénom*",
                'attr' => ['placeholder' => "Prénom"],
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ]),
                ],
            ])
            ->add('prenom2', TextType::class, [
                'label' => "Prénom 2*",
                'attr' => ['placeholder' => "Prénom2"],
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ]),
                ],
            ])
            ->add('domicile', TextType::class, [
                'label' => "Domicile*",
                'attr' => ['placeholder' => "domicile"],
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ]),
                ],
            ])
            ->add('telpersonnel', TextType::class, [
                'label' => "Téléphone personnel",
                'attr' => ['placeholder' => "Téléphone personnel"],
                'required' => false,
            ])
            ->add('poste', TextType::class, [
                'label' => "Poste*",
                'attr' => ['placeholder' => "Poste*"],
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ]),
                ],
            ])
            ->add('service', TextType::class, [
                'label' => "Service*",
                'attr' => ['placeholder' => "Service*"],
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ]),
                ],
            ])
            ->add('entreprise', TextType::class, [
                'label' => "Entreprise*",
                'attr' => ['placeholder' => "Entreprise*"],
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ]),
                ],
            ])
            ->add('emailPerso', EmailType::class, [
                'label' => 'Email perso',
                'attr' => ['placeholder' => 'Email perso'],
                'required' => false,
                'required' => false,
                'constraints' => [
                    new Email([
                        'message' => 'Veuillez saisir une adresse email valide',
                    ]),
                ],
            ])
            ->add('imageFile', VichImageType::class, [
                'label' => 'Photo (png, jpg et jpeg)',
                'required'  =>  false,
                'allow_delete' =>  false,
                'download_label'     =>  false,
                'image_uri'     =>  false,
                'download_uri'     =>  false,
                'imagine_pattern'   =>  'identite_size',
            ])
            ->add('civilite', ChoiceType::class, [
                'label' => "Civilité*",
                'choices'  => [
                    'Monsieur'    =>  'Mr',
                    'Madamme' =>  'Mme',
                ],
                'expanded' => false,
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ]),
                ],
            ])
            ->add('adresse', TextType::class, [
                'label' => "Adresse",
                'attr' => ['placeholder' => "adresse"],
                'required' => false
            ])
            ->add('telephone', TextType::class, [
                'label' => "Téléphone",
                'attr' => ['placeholder' => "Téléphone"],
                'required' => false
            ])
            ->add('telephone', TextType::class, [
                'label' => "Téléphone",
                'attr' => ['placeholder' => "Téléphone"],
                'required' => false
            ])
            ->add('numPermis', TextType::class, [
                'label' => "Num permis",
                'attr' => ['placeholder' => "Num permis"],
                'required' => false
            ])
            ->add('villePermis', TextType::class, [
                'label' => "Ville permis",
                'attr' => ['placeholder' => "Ville permis"],
                'required' => false
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email*',
                'attr' => ['placeholder' => 'Email*'],
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ]),
                    new Email([
                        'message' => 'Veuillez saisir une adresse email valide',
                    ]),
                ],
            ])
            ->add('memo', TextareaType::class, [
                'label' => "Memo",
                'attr' => ['placeholder' => "Memo", 'rows' => 6],
                'required' => false
            ])
            ->add('emeteurPasseport', TextareaType::class, [
                'label' => "Emeteur passeport",
                'attr' => ['placeholder' => "Emeteur passeport"],
                'required' => false
            ])
            ->add('typeContrat', ChoiceType::class, [
                'label' => "Type de contrat*",
                'choices'  => [
                    'CDD'    =>  'CDD',
                    'CDI' =>  'CDI',
                ],
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ]),
                ],
            ])
            ->add('typePermis', ChoiceType::class, [
                'label' => "Type de permis*",
                'choices'  => [
                    'Type 1'    =>  'Type 1',
                    'Type 2' =>  'Type 2',
                ],
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ]),
                ],
            ])
            ->add('statut', ChoiceType::class, [
                'label' => false,
                'choices'  => [
                    'Actif'    =>  'Actif',
                    'Interne' =>  'Interne',
                ],
                'expanded' => true,
                'multiple' => true,
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ]),
                ],
            ])
            ->add('chauffeur', CheckboxType::class, [
                'label' => "Chauffeur",
                'required'  => false
            ])
            ->add('chauffeur', CheckboxType::class, [
                'label' => "Chauffeur",
                'required'  => false
            ])
            ->add('cadeauFinAnnee', CheckboxType::class, [
                'label' => "Cadeau Fin Année",
                'required'  => false
            ])
            ->add('societe', TextType::class, [
                'label' => "Sociéte",
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ]),
                ],
            ])
            ->add('appartenance', TextType::class, [
                'label' => "Appartenance",
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ]),
                ],
            ])
            ->add('taille', NumberType::class, [
                'label' => "Taille",
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ]),
                ],
            ])
            ->add('pointure', TextType::class, [
                'label' => "Pointure",
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ]),
                ],
            ])
            ->add('contactsUrgence', TextareaType::class, [
                'label' => "Contacts en cas d'urgence",
                'required' => false
            ])
            ->add('dateEntre', DateType::class, [
                'label'     =>  "Date d'entrée",
                'widget' => 'single_text',
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ])
                ],
            ])
            ->add('datenaissance', DateType::class, [
                'label'     =>  "Date de naissance",
                'widget' => 'single_text',
                'required' => false
            ])
            ->add('numcartetachy', TextType::class, [
                'label'     =>  "Num carte Tachy",
                'required' => false
            ])
            ->add('villenaissance', TextType::class, [
                'label'     =>  "Ville de naissance",
                'required' => false
            ])
            ->add('nationalite', TextType::class, [
                'label'     =>  "Nationalité",
                'required' => false
            ])
            ->add('numCarteVital', TextType::class, [
                'label'     =>  "Num Carte Vital",
                'required' => false
            ])
            ->add('dateFinContrat', DateType::class, [
                'label'     =>  'Date de fin de contrat',
                'widget' => 'single_text',
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ])
                ],
            ])
            ->add('dateDebutEnciennete', DateType::class, [
                'label'     =>  'Date debut enciennete',
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('pieces', CollectionType::class, [
                'entry_type' => PieceType::class,
                'label' => 'Piece jointe',
                'entry_options' => [
                    'label' => false,
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Conducteur::class,
        ]);
    }
}
