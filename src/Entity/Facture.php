<?php

namespace App\Entity;

use App\Entity\Traits\Timestamp;
use App\Repository\FactureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FactureRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Facture
{
    use Timestamp;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $designation;

    #[ORM\Column(type: 'string', length: 255)]
    private $document;

    #[ORM\Column(type: 'boolean')]
    private $statut;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'factures')]
    private $client;

    #[ORM\ManyToOne(targetEntity: Commande::class, inversedBy: 'factures')]
    #[ORM\JoinColumn(onDelete: "CASCADE")]
    private $commande;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $receved;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(?string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getDocument(): ?string
    {
        return $this->document;
    }

    public function setDocument(string $document): self
    {
        $this->document = $document;

        return $this;
    }

    public function getStatut(): ?bool
    {
        return $this->statut;
    }

    public function setStatut(bool $statut): self
    {
        $this->statut = $statut;

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

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): self
    {
        $this->commande = $commande;

        return $this;
    }

    public function getReceved(): ?bool
    {
        return $this->receved;
    }

    public function setReceved(?bool $receved): self
    {
        $this->receved = $receved;

        return $this;
    }
}
