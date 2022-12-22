<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
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
   public $vehicules;

   /**
    * @var ArrayCollection|null
    */
   public $clients;

   /**
    * @var ArrayCollection|null
    */
   public $destinations;

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
      $this->vehicules = new ArrayCollection();
      $this->clients = new ArrayCollection();
      $this->destinations = new ArrayCollection();
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
   public function getDestinations(): ?ArrayCollection
   {
      return $this->destinations;
   }

   /**
    * @param ArrayCollection $itineraires
    */
   public function setDestinations(?ArrayCollection $destinations): void
   {
      $this->$destinations = $destinations;
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