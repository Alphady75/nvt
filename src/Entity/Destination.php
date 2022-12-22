<?php

namespace App\Entity;

use App\Entity\Traits\Timestamp;
use App\Repository\DestinationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DestinationRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Destination
{
    use Timestamp;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $adresseChargement;

    #[ORM\ManyToMany(targetEntity: Commande::class, mappedBy: 'destinations')]
    private $commandes;

    #[ORM\ManyToOne(targetEntity: Itineraire::class, inversedBy: 'dateChargement')]
    private $adresseLivraison;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $dateChargement;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $dateLivraison;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $lienMap;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdresseChargement(): ?string
    {
        return $this->adresseChargement;
    }

    public function setAdresseChargement(?string $adresseChargement): self
    {
        $this->adresseChargement = $adresseChargement;

        return $this;
    }

    public function __toString()
    {
        return $this->getAdresseChargement();
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->addDestination($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            $commande->removeDestination($this);
        }

        return $this;
    }

    public function getAdresseLivraison(): ?Itineraire
    {
        return $this->adresseLivraison;
    }

    public function setAdresseLivraison(?Itineraire $adresseLivraison): self
    {
        $this->adresseLivraison = $adresseLivraison;

        return $this;
    }

    public function getDateChargement(): ?\DateTimeInterface
    {
        return $this->dateChargement;
    }

    public function setDateChargement(?\DateTimeInterface $dateChargement): self
    {
        $this->dateChargement = $dateChargement;

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

    public function getLienMap(): ?string
    {
        return $this->lienMap;
    }

    public function setLienMap(?string $lienMap): self
    {
        $this->lienMap = $lienMap;

        return $this;
    }
}
