<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class EditUserType extends AbstractType
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
                'label' => false,
                'help' => 'Facultatif',
                'attr' => ['rows' => 6],
                'required' => false
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'Photo (png, jpg et jpeg)',
                'required'  =>  false,
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
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}