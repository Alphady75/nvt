<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\CategorieImmobilier;
use App\Entity\Ville;
use Doctrine\Persistence\ObjectManager;

class FiltreCommande
{
   /**
    * @var int
    */
   public $page = 1;

   /**
    * @var ArrayCollection|null
    */
   public $secteurs;

   /**
    * @var ArrayCollection|null
    */
   public $villes;

   /**
    * @var ArrayCollection|null
    */
   public $vehicules;

   /**
    * @var ArrayCollection|null
    */
   public $clients;

   /**
    * @var ArrayCollection|null
    */
   public $itineraires;

   /**
    * @var DateTimeInterface|null
    */
   public $dateReception = null;

   /**
    * @var DateTimeInterface|null
    */
   public $dateLivraison = null;

   /**
    * @var boolean
    */
   public $statut = null;

   public function __construct()
   {
      $this->secteurs = new ArrayCollection();
      $this->villes = new ArrayCollection();
      $this->vehicules = new ArrayCollection();
      $this->clients = new ArrayCollection();
      $this->itineraires = new ArrayCollection();
   }

   /**
    * @return ArrayCollection
    */
   public function getSecteurs(): ?ArrayCollection
   {
      return $this->secteurs;
   }

   /**
    * @param ArrayCollection $secteurs
    */
   public function setSecteurs(?ArrayCollection $secteurs): void
   {
      $this->secteurs = $secteurs;
   }

   /**
    * @return ArrayCollection
    */
   public function getVilles(): ?ArrayCollection
   {
      return $this->villes;
   }

   /**
    * @param ArrayCollection $villes
    */
   public function setVilles(?ArrayCollection $villes): void
   {
      $this->villes = $villes;
   }

   /**
    * @return ArrayCollection
    */
   public function getVehicules(): ?ArrayCollection
   {
      return $this->vehicules;
   }

   /**
    * @param ArrayCollection $vehicules
    */
   public function setVehicules(?ArrayCollection $vehicules): void
   {
      $this->vehicules = $vehicules;
   }

   /**
    * @return ArrayCollection
    */
   public function getClients(): ?ArrayCollection
   {
      return $this->clients;
   }

   /**
    * @param ArrayCollection $clients
    */
   public function setClients(?ArrayCollection $clients): void
   {
      $this->clients = $clients;
   }

   /**
    * @return ArrayCollection
    */
   public function getItineraires(): ?ArrayCollection
   {
      return $this->itineraires;
   }

   /**
    * @param ArrayCollection $itineraires
    */
   public function setItineraires(?ArrayCollection $itineraires): void
   {
      $this->$itineraires = $itineraires;
   }

   public function getDateReception(): ?\DateTimeInterface
   {
      return $this->dateReception;
   }

   public function setDateReception(?\DateTimeInterface $dateReception): self
   {
      $this->dateReception = $dateReception;

      return $this;
   }

   public function getDateLivraison(): ?\DateTimeInterface
   {
      return $this->dateLivraison;
   }

   public function setDateLivraison(?\DateTimeInterface $dateLivraison): self
   {
      $this->dateLivraison = $dateLivraison;

      return $this;
   }
}