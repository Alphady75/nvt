<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => "Nom(s)",
                'attr' => ['placeholder' => "nom(s)"],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ]),
                ],
            ])
            ->add('prenom', TextType::class, [
                'label' => "Prénom(s)",
                'attr' => ['placeholder' => "prénom(s)"],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ]),
                ],
            ])
            /*->add('dateNaissance', DateType::class, [
                'label'     =>  false,
                'widget' => 'single_text',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Quelle est la date de naissance?',
                    ])
                ],
            ])*/
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => ['placeholder' => 'Exemple@domail.com'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ]),
                    new Email([
                        'message' => 'Veuillez saisir une adresse email valide',
                    ]),
                ],
            ])
            ->add('genre', ChoiceType::class, [
                'label' => "Genre",
                'choices'  => [
                    'Homme'    =>  'Homme',
                    'Femme' =>  'Femme',
                ],
                'expanded' => true,
                'multiple' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Quel est le genre de cet utilisateur?',
                    ]),
                ],
            ])
            ->add('apropos', TextareaType::class, [
                'label' => 'A propos',
                'help' => 'Facultatif',
                'required' => false,
                'attr' => ['rows' => 8]
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'Photo (png, jpg et jpeg)',
                'required'  =>  false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ]),
                ],
            ])
            ->add('roles', ChoiceType::class, [
                'label' => "Rôle",
                'help' => "Droits d'accès",
                'choices'  => [
                    'Aministrateur'    =>  'ROLE_ADMIN',
                    'Modérateur' =>  'ROLE_MODERATEUR',
                    'Editeur' =>  'ROLE_EDITEUR',
                    'Gestionnaire de facture' =>  'ROLE_GESTIONNAIRE',
                ],
                'expanded' => true,
                'multiple' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Quel est le role de cet utilisateur?',
                    ]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'attr' => ['autocomplete' => 'new-password', 'placeholder' => 'Nouveau mot de passe****', 'class' => 'w-100 mb-3'],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Veuillez saisir votre mot de passe',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'Votre mot de passe doit avoir en minimum {{ limit }} caractères',
                                // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                    ],
                    'label' => 'Nouveau mot de passe*',
                ],
                'second_options' => [
                    'attr' => ['autocomplete' => 'new-password', 'placeholder' => 'Confirmation du mot de passe****', 'class' => 'w-100'],
                    'label' => 'Confirmer mot de passe*',
                ],
                'invalid_message' => 'Les deux mots de passe ne correspondent pas.',
                    // Instead of being set onto the object directly,
                    // this is read and encoded in the controller
                'mapped' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}