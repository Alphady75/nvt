<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Ville;
use App\Entity\FiltreCommande;
use App\Entity\Itineraire;
use App\Entity\Secteur;
use App\Entity\Vehicule;
use App\Repository\ClientRepository;
use App\Repository\ItineraireRepository;
use App\Repository\SecteurRepository;
use App\Repository\VehiculeRepository;
use App\Repository\VilleRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FiltreCommandeType extends AbstractType
{
   public function buildForm(FormBuilderInterface $builder, array $options): void
   {
      $builder
         ->add('dateReception', DateType::class, [
            'label' => False,
            'help'     =>  'Date de reception',
            'widget' => 'single_text',
            'required' => false,
         ])
         ->add('dateLivraison', DateType::class, [
            'label' => False,
            'help'     =>  'Date de livraison',
            'widget' => 'single_text',
            'required' => false,
         ])
         ->add('secteurs', EntityType::class, [
            'label' => False,
            'help' => "Secteurs",
            'multiple' => true,
            'required' => false,
            'autocomplete' => true,
            //'expanded' => true,
            'class' => Secteur::class,
            'query_builder' => function (SecteurRepository $getsecteurs) {
               return $getsecteurs->createQueryBuilder('s')
                  ->orderBy('s.name', 'ASC');
            },
            'choice_label' => 'name',
            'attr' => ['class' => 'p-0 m-0 border-0']
         ])
         ->add('villes', EntityType::class, [
            'label' => False,
            'required' => false,
            'autocomplete' => true,
            'help' => "Villes",
            'multiple' => true,
            //'expanded' => true,
            'class' => Ville::class,
            'query_builder' => function (VilleRepository $getville) {
               return $getville->createQueryBuilder('v')
                  ->orderBy('v.name', 'ASC');
            },
            'choice_label' => 'name',
            'attr' => ['class' => 'p-0 m-0 border-0']
         ])
         ->add('vehicules', EntityType::class, [
            'label' => False,
            'required' => false,
            'autocomplete' => true,
            'help' => "Vehicules",
            'multiple' => true,
            //'expanded' => true,
            'class' => Vehicule::class,
            'query_builder' => function (VehiculeRepository $getvehicule) {
               return $getvehicule->createQueryBuilder('v')
                  ->orderBy('v.name', 'ASC');
            },
            'choice_label' => 'name',
            'attr' => ['class' => 'p-0 m-0 border-0']
         ])
         ->add('clients', EntityType::class, [
            'label' => False,
            'required' => false,
            'autocomplete' => true,
            'help' => "Clients",
            'multiple' => true,
            //'expanded' => true,
            'class' => Client::class,
            'query_builder' => function (ClientRepository $getclients) {
               return $getclients->createQueryBuilder('c')
                  ->orderBy('c.nom', 'ASC');
            },
            //'choice_label' => 'nom',
            'attr' => ['class' => 'p-0 m-0 border-0']
         ])
         ->add('itineraires', EntityType::class, [
            'label' => False,
            'required' => false,
            'autocomplete' => true,
            'help' => "Itineraires",
            'multiple' => true,
            //'expanded' => true,
            'class' => Itineraire::class,
            'query_builder' => function (ItineraireRepository $getitineraires) {
               return $getitineraires->createQueryBuilder('i')
                  ->orderBy('i.designation', 'ASC');
            },
            //'choice_label' => 'name',
            'attr' => ['class' => 'p-0 m-0 border-0']
         ])
         ->add('statut', CheckboxType::class, [
            'label' => "Commandes validée",
            'required' => false
         ]);
   }

   public function configureOptions(OptionsResolver $resolver): void
   {
      $resolver->setDefaults([
         'data_class' => FiltreCommande::class,
         'method' => 'GET',
         'csrf_protection' => false,
      ]);
   }

   public function getBlockPrefix()
   {
      return '';
   }
}