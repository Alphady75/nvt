<?php

namespace App\Entity;

use App\Entity\Traits\Timestamp;
use App\Repository\ItineraireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItineraireRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Itineraire
{
    use Timestamp;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $designation;

    #[ORM\Column(type: 'float')]
    private $tarif;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'itineraires')]
    #[ORM\JoinColumn(onDelete: "CASCADE")]
    private $client;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\OneToMany(mappedBy: 'itineraire', targetEntity: Commande::class)]
    #[ORM\JoinColumn(onDelete: "CASCADE")]
    private $commandes;

    #[ORM\Column(type: 'string', length: 255)]
    private $adresse;

    #[ORM\OneToMany(mappedBy: 'adresseLivraison', targetEntity: Destination::class)]
    #[ORM\JoinColumn(onDelete: "CASCADE")]
    private $dateChargement;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
        $this->dateChargement = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getTarif(): ?float
    {
        return $this->tarif;
    }

    public function setTarif(float $tarif): self
    {
        $this->tarif = $tarif;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function __toString()
    {
        return $this->getDesignation() . ' - ' . $this->getAdresse();
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection|Destination[]
     */
    public function getDateChargement(): Collection
    {
        return $this->dateChargement;
    }

    public function addDateChargement(Destination $dateChargement): self
    {
        if (!$this->dateChargement->contains($dateChargement)) {
            $this->dateChargement[] = $dateChargement;
            $dateChargement->setAdresseLivraison($this);
        }

        return $this;
    }

    public function removeDateChargement(Destination $dateChargement): self
    {
        if ($this->dateChargement->removeElement($dateChargement)) {
            // set the owning side to null (unless already changed)
            if ($dateChargement->getAdresseLivraison() === $this) {
                $dateChargement->setAdresseLivraison(null);
            }
        }

        return $this;
    }
}