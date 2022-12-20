<?php

namespace App\Entity;

use App\Entity\Traits\Timestamp;
use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Commande
{
    use Timestamp;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'float', nullable: true)]
    private $tarif;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'commandes')]
    private $client;

    #[ORM\ManyToOne(targetEntity: Vehicule::class, inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private $vehicule;

    #[ORM\ManyToOne(targetEntity: Conducteur::class, inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private $conducteur;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $dateReception;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $dateLivraison;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\Column(type: 'text', nullable: true)]
    private $qrcode;

    #[ORM\Column(type: 'text', nullable: true)]
    private $observation;

    #[ORM\ManyToOne(targetEntity: Itineraire::class, inversedBy: 'commandes')]
    private $itineraire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVehicule(): ?Vehicule
    {
        return $this->vehicule;
    }

    public function setVehicule(?Vehicule $vehicule): self
    {
        $this->vehicule = $vehicule;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getConducteur(): ?Conducteur
    {
        return $this->conducteur;
    }

    public function setConducteur(?Conducteur $conducteur): self
    {
        $this->conducteur = $conducteur;

        return $this;
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

    public function getTarif(): ?float
    {
        return $this->tarif;
    }

    public function setTarif(?float $tarif): self
    {
        $this->tarif = $tarif;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getQrcode(): ?string
    {
        return $this->qrcode;
    }

    public function setQrcode(?string $qrcode): self
    {
        $this->qrcode = $qrcode;

        return $this;
    }

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(?string $observation): self
    {
        $this->observation = $observation;

        return $this;
    }

    public function getItineraire(): ?Itineraire
    {
        return $this->itineraire;
    }

    public function setItineraire(?Itineraire $itineraire): self
    {
        $this->itineraire = $itineraire;

        return $this;
    }
}