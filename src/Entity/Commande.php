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
    #[ORM\JoinColumn(onDelete: "CASCADE")]
    private $client;

    #[ORM\ManyToOne(targetEntity: Vehicule::class, inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private $vehicule;

    #[ORM\ManyToOne(targetEntity: Conducteur::class, inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private $conducteur;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private $user;

    #[ORM\Column(type: 'text', nullable: true)]
    private $qrcode;

    #[ORM\Column(type: 'text', nullable: true)]
    private $observation;

    #[ORM\ManyToMany(targetEntity: Destination::class, inversedBy: 'commandes', cascade: ["persist"])]
    private $destinations;

    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: Facture::class, cascade: ['persist', 'remove'])]
    private $factures;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $emballage;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $mailSent;

    public function __construct()
    {
        $this->destinations = new ArrayCollection();
        $this->factures = new ArrayCollection();
    }
    
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

    /**
     * @return Collection|Destination[]
     */
    public function getDestinations(): Collection
    {
        return $this->destinations;
    }

    public function addDestination(Destination $destination): self
    {
        if (!$this->destinations->contains($destination)) {
            $this->destinations[] = $destination;
        }

        return $this;
    }

    public function removeDestination(Destination $destination): self
    {
        $this->destinations->removeElement($destination);

        return $this;
    }

    /**
     * @return Collection|Facture[]
     */
    public function getFactures(): Collection
    {
        return $this->factures;
    }

    public function addFacture(Facture $facture): self
    {
        if (!$this->factures->contains($facture)) {
            $this->factures[] = $facture;
            $facture->setCommande($this);
        }

        return $this;
    }

    public function removeFacture(Facture $facture): self
    {
        if ($this->factures->removeElement($facture)) {
            // set the owning side to null (unless already changed)
            if ($facture->getCommande() === $this) {
                $facture->setCommande(null);
            }
        }

        return $this;
    }

    public function getEmballage(): ?bool
    {
        return $this->emballage;
    }

    public function setEmballage(?bool $emballage): self
    {
        $this->emballage = $emballage;

        return $this;
    }

    public function getMailSent(): ?bool
    {
        return $this->mailSent;
    }

    public function setMailSent(?bool $mailSent): self
    {
        $this->mailSent = $mailSent;

        return $this;
    }
}