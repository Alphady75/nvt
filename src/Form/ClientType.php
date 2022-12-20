<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\PalEurope;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code', TextType::class, [])
            ->add('num', NumberType::class, [])
            ->add('siret', TextType::class, [])
            ->add('apeNaf', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ])
                ],
            ])
            ->add('numTva', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ])
                ],
            ])
            ->add('type', ChoiceType::class, [
                'label' => "Type*",
                'choices'  => [
                    'Client'    =>  'Client',
                    'Entreprise' =>  'Entreprise',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ]),
                ],
            ])
            ->add('raisonSociale', TextType::class, [])
            ->add('groupeClient', TextType::class, [])
            ->add('sousGroupe', TextType::class, [])
            ->add('respFacturation', TextType::class, [])
            ->add('respSaisie', TextType::class, [])
            ->add('typeSuivi', ChoiceType::class, [
                'label' => "Type suivis",
                'choices'  => [
                    'TRAVIS'    =>  'TRAVIS',
                    'Entreprise' =>  'Entreprise',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ]),
                ],
            ])
            ->add('shippeo', TextType::class, [])
            ->add('decodageAdr', CheckboxType::class, [
                'label' => false
            ])
            ->add('adresseValide', CheckboxType::class, [
                'label' => false
            ])
            ->add('statut', ChoiceType::class, [
                'label' => "Statut*",
                'choices'  => [
                    'En service' =>  0,
                    'Livrée' =>  1,
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ]),
                ],
            ])
            ->add('nom', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ])
                ],
            ])
            ->add('prenom', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ])
                ],
            ])
            ->add('civilite', ChoiceType::class, [
                'label' => false,
                'help' => 'Civilité',
                'choices'  => [
                    'Monsieur'    =>  'Mr',
                    'Madamme' =>  'Mme',
                ],
                'expanded' => false,
                'multiple' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est obligatoire',
                    ]),
                ],
            ])
            ->add('adresse', TextType::class, [])
            ->add('telephone', TextType::class, [])
            ->add('email', EmailType::class, [
                'label' => 'Email*',
                'attr' => ['placeholder' => 'Email*'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis',
                    ]),
                    new Email([
                        'message' => 'Veuillez saisir une adresse email valide',
                    ]),
                ],
            ])
            ->add('sectAppartenance', TextType::class, [])
            ->add('sectCompte', TextType::class, [])
            ->add('ville', TextType::class, [])
            ->add('secteur', TextType::class, [])
            ->add('sectNumSiret', TextType::class, [])
            ->add('facValJournaliere', CheckboxType::class, [
                'label' => false
            ])
            ->add('factTarif', NumberType::class, [
                'attr' => ['placeholder' => 'Tarif']
            ])
            ->add('edition', ChoiceType::class, [
                'label' => "Edition",
                'choices'  => [
                    'Chargement'    =>  'chargement',
                    'Location' =>  'location',
                ],
                'expanded' => false,
            ])
            ->add('editionStartAt', TimeType::class, [
                //'input'  => 'timestamp',
                'widget' => 'single_text',
            ])
            ->add('editionEndAt', TimeType::class, [
                //'input'  => 'timestamp',
                'widget' => 'single_text',
            ])
            ->add('factMode', ChoiceType::class, [
                'label' => "Mode de facturation",
                'multiple' => true,
                'choices'  => [
                    'Chargement CL'    =>  'chargement-cl',
                    'Location' =>  'location',
                ],
                'expanded' => true,
            ])
            ->add('memoTrans', TextareaType::class, [
                'attr' => ['rows' => 4]
            ])
            ->add('indFeuilleRoute', TextareaType::class, [
                'attr' => ['rows' => 4]
            ])
            ->add('contFonction', TextType::class, [])
            ->add('contFix', TextType::class, [])
            ->add('contFax', TextType::class, [])
            ->add('demandes', ChoiceType::class, [
                'label' => "Demandes client",
                'multiple' => true,
                'choices'  => [
                    '19 Tonnes'    =>  '19 Tonnes',
                    '26 Tonnes' =>  '26 Tonnes',
                    '21 palette' =>  '21 palette',
                    '24 palette' =>  '24 palette',
                    '18 palette' =>  '18 palette',
                    '16 palette' =>  '16 palette',
                    'Azote' =>  'Azote',
                    'Bi tempera' =>  'Bi tempera',
                    'Gaz nature' =>  'Gaz nature',
                    'Hybride' =>  'Hybride',
                    'Arretoire' =>  'Arretoire',
                    'Clison' =>  'Clison',
                    'Semi artic' =>  'Semi artic',
                ],
                'expanded' => true,
            ])
            ->add('mailSms', ChoiceType::class, [
                'label' => "Mail/sms",
                'multiple' => true,
                'choices'  => [
                    'Sans liv port'    =>  'sans-liv-port',
                    'Sans liv semi' =>  'Sans-lis-semi',
                ],
                'expanded' => true,
            ])
            ->add('duplicationSms', ChoiceType::class, [
                'label' => "Duplication sms",
                'multiple' => true,
                'choices'  => [
                    'Actif'    =>  'Actif',
                    'Duplication'    =>  'Duplication',
                    'Avec memo ch'    =>  'Avec memo ch',
                    'sms ref'    =>  'sms ref',
                    'avec livraison'    =>  'avec livraison',
                    'avec ref client'    =>  'avec ref client',
                    'sms nature'    =>  'sms nature',
                ],
                'expanded' => true,
            ])
            ->add('tolAttenteCha', NumberType::class, [])
            ->add('tolRetardCha', NumberType::class, [])
            ->add('calAttanteCha', ChoiceType::class, [])
            ->add('tolAttenteLiv', NumberType::class, [])
            ->add('tolRetardLiv', NumberType::class, [])
            ->add('calAttanteLiv', ChoiceType::class, [])
            ->add('palEurope', EntityType::class, [
                'label'     =>  'Pal Europe*',
                'placeholder'     =>  '--Pal Europe--',
                'class' => PalEurope::class,
            ])
            ->add('planChar', CheckboxType::class, ['label' => false])
            ->add('planCodeChar', CheckboxType::class, ['label' => false])
            ->add('planSupChar', TextType::class, [])
            ->add('planNbCarChar', NumberType::class, [])
            ->add('planVideChar', CheckboxType::class, ['label' => false])
            ->add('planRefClientChar', CheckboxType::class, ['label' => false])
            ->add('planSup2Char', TextType::class, [])
            ->add('planNbCar2Char', NumberType::class, [])
            ->add('planLiv', CheckboxType::class, ['label' => false])
            ->add('planLivCode', TextType::class, [])
            ->add('planLivSup', TextType::class, [])
            ->add('planLivNbCar', NumberType::class, [])
            ->add('planLivRefClient', CheckboxType::class, ['label' => false])
            ->add('planLivSup2', TextType::class, [])
            ->add('feuilleChar', CheckboxType::class, ['label' => false])
            ->add('feuilleCodeChar', CheckboxType::class, ['label' => false])
            ->add('feuilleSupChar', TextType::class, [])
            ->add('feuilleNbCarChar', NumberType::class, [])
            ->add('feuilleVideChar', CheckboxType::class, ['label' => false])
            ->add('feuilleRefClientChar', CheckboxType::class, ['label' => false])
            ->add('feuilleLiv', CheckboxType::class, ['label' => false])
            ->add('feuilleLivCode', TextType::class, [])
            ->add('feuilleLivSup', TextType::class, [])
            ->add('feuilleLivNbCar', NumberType::class, [])
            ->add('feuilleLivRefClient', CheckboxType::class, ['label' => false])
            ->add('comptFourTrCpt', TextType::class, [])
            ->add('comptFourCcMulti', CheckboxType::class, ['label' => 'CC Multisociéte'])
            ->add('comptFourModReg', TextType::class, [])
            ->add('comptFourTypeReg', TextType::class, [])
            ->add('comptFourTypeRegParc', TextType::class, [])
            ->add('comptFourJoursPaiement', NumberType::class, [])
            ->add('comptFourActAchat', TextType::class, [])
            ->add('comptFourGrTaxAchats', ChoiceType::class, [])
            ->add('comptFourFactAout', CheckboxType::class, ['label' => false])
            ->add('comptFourCertifStartAt', DateType::class, ['widget' => 'single_text',])
            ->add('comptFourCertifEndAt', DateType::class, ['widget' => 'single_text',])
            ->add('comptFourRef', TextType::class, [])
            ->add('comptClientTrCpt', TextType::class, [])
            ->add('comptClientCompte', TextType::class, [
                'attr' => ['maxlength' => 10, 'minlength' => 10],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ est requis!',
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Ce champ doit avoir en maximum {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('comptClientCcMulti', CheckboxType::class, ['label' => 'CC Multisociéte'])
            ->add('comptClientModReg', TextType::class, [])
            ->add('comptClientTypeReg', TextType::class, [])
            ->add('comptClientTypeRegParc', TextType::class, [])
            ->add('comptClientJoursPaiement', NumberType::class, [])
            ->add('comptClientActVente', TextType::class, [])
            ->add('comptClientGrTaxVentes', ChoiceType::class, [])
            ->add('comptClientFactAout', CheckboxType::class, ['label' => false])
            ->add('comptClientCertifStartAt', DateType::class, ['widget' => 'single_text',])
            ->add('comptClientCertifEndAt', DateType::class, ['widget' => 'single_text',])
            ->add('comptClientRef', TextType::class, [])
            ->add('relanceNom', TextType::class, [])
            ->add('relanceTel', TextType::class, [])
            ->add('relanceTel2', TextType::class, [])
            ->add('relanceEmail', TextType::class, [])
            ->add('relanceMemo', TextareaType::class, ['attr' => ['rows' => 4]])
            ->add('relanceJours', NumberType::class, [])
            ->add('adresseType', TextType::class, [])
            ->add('adresseCode', TextType::class, [])
            ->add('adresseNom', TextType::class, [])
            ->add('adresseDep', TextType::class, [])
            ->add('adresseRef', TextType::class, [])
            ->add('adresseVille', TextType::class, []);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}