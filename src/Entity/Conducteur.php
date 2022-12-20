<?php

namespace App\Entity;

use App\Entity\Traits\Timestamp;
use App\Repository\ConducteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConducteurRepository::class)]
#[ORM\HasLifecycleCallbacks]
/**
 * @UniqueEntity(fields={"email"}, message="Un conduteur a déjà été ajouter avec cette e-mail")
 * @Vich\Uploadable
 */
class Conducteur
{
    use Timestamp;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $prenom;

    /**
     * @Vich\UploadableField(mapping="conducteurs_images", fileNameProperty="imageName")
     * @var File|null
     * @Assert\Image(maxSize="10M", maxSizeMessage="Image trop volumineuse maximum 10Mb")
     * @Assert\Image(mimeTypes = {"image/jpeg", "image/jpg", "image/png"}, mimeTypesMessage = "Mauvais format d'image (jpeg, jpg et png)")
    **/
    private $imageFile;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $imageName;

    #[ORM\Column(type: 'string', length: 40)]
    private $civilite;

    #[ORM\Column(type: 'string', length: 255)]
    private $code;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $adresse;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $telephone;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\Column(type: 'text', nullable: true)]
    private $memo;

    #[ORM\OneToMany(mappedBy: 'conducteur', targetEntity: Commande::class)]
    private $commandes;

    #[ORM\Column(type: 'string', length: 255)]
    private $typeContrat;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $dateEntre;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $dateFinContrat;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $poste;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $service;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $entreprise;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $dateDebutEnciennete;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $domicile;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $telpersonnel;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $datenaissance;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $numcartetachy;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $chauffeur;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $typePermis;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $villenaissance;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $numPermis;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $villePermis;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $nationalite;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $numCarteVital;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $prenom2;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $societe;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $emailPerso;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $appartenance;

    #[ORM\Column(type: 'text', nullable: true)]
    private $contactsUrgence;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $taille;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $pointure;

    #[ORM\Column(type: 'text', nullable: true)]
    private $emeteurPasseport;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $cadeauFinAnnee;

    #[ORM\Column(type: 'array', length: 255, nullable: true)]
    private $statut;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getCivilite(): ?string
    {
        return $this->civilite;
    }

    public function setCivilite(string $civilite): self
    {
        $this->civilite = $civilite;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->setUpdated(new \DateTimeImmutable());
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getMemo(): ?string
    {
        return $this->memo;
    }

    public function setMemo(?string $memo): self
    {
        $this->memo = $memo;

        return $this;
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
            $commande->setConducteur($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getConducteur() === $this) {
                $commande->setConducteur(null);
            }
        }

        return $this;
    }

    public function getTypeContrat(): ?string
    {
        return $this->typeContrat;
    }

    public function setTypeContrat(string $typeContrat): self
    {
        $this->typeContrat = $typeContrat;

        return $this;
    }

    public function getDateEntre(): ?\DateTimeInterface
    {
        return $this->dateEntre;
    }

    public function setDateEntre(?\DateTimeInterface $dateEntre): self
    {
        $this->dateEntre = $dateEntre;

        return $this;
    }

    public function getDateFinContrat(): ?\DateTimeInterface
    {
        return $this->dateFinContrat;
    }

    public function setDateFinContrat(?\DateTimeInterface $dateFinContrat): self
    {
        $this->dateFinContrat = $dateFinContrat;

        return $this;
    }

    public function __toString()
    {
        return $this->getNom() . ' ' . $this->getPrenom() . ' ' . $this->getEmail();
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(?string $poste): self
    {
        $this->poste = $poste;

        return $this;
    }

    public function getService(): ?string
    {
        return $this->service;
    }

    public function setService(?string $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function getEntreprise(): ?string
    {
        return $this->entreprise;
    }

    public function setEntreprise(?string $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getDateDebutEnciennete(): ?\DateTimeInterface
    {
        return $this->dateDebutEnciennete;
    }

    public function setDateDebutEnciennete(?\DateTimeInterface $dateDebutEnciennete): self
    {
        $this->dateDebutEnciennete = $dateDebutEnciennete;

        return $this;
    }

    public function getDomicile(): ?string
    {
        return $this->domicile;
    }

    public function setDomicile(?string $domicile): self
    {
        $this->domicile = $domicile;

        return $this;
    }

    public function getTelpersonnel(): ?string
    {
        return $this->telpersonnel;
    }

    public function setTelpersonnel(?string $telpersonnel): self
    {
        $this->telpersonnel = $telpersonnel;

        return $this;
    }

    public function getDatenaissance(): ?\DateTimeInterface
    {
        return $this->datenaissance;
    }

    public function setDatenaissance(?\DateTimeInterface $datenaissance): self
    {
        $this->datenaissance = $datenaissance;

        return $this;
    }

    public function getNumcartetachy(): ?string
    {
        return $this->numcartetachy;
    }

    public function setNumcartetachy(?string $numcartetachy): self
    {
        $this->numcartetachy = $numcartetachy;

        return $this;
    }

    public function getChauffeur(): ?bool
    {
        return $this->chauffeur;
    }

    public function setChauffeur(?bool $chauffeur): self
    {
        $this->chauffeur = $chauffeur;

        return $this;
    }

    public function getTypePermis(): ?string
    {
        return $this->typePermis;
    }

    public function setTypePermis(?string $typePermis): self
    {
        $this->typePermis = $typePermis;

        return $this;
    }

    public function getVillenaissance(): ?string
    {
        return $this->villenaissance;
    }

    public function setVillenaissance(?string $villenaissance): self
    {
        $this->villenaissance = $villenaissance;

        return $this;
    }

    public function getNumPermis(): ?string
    {
        return $this->numPermis;
    }

    public function setNumPermis(?string $numPermis): self
    {
        $this->numPermis = $numPermis;

        return $this;
    }

    public function getVillePermis(): ?string
    {
        return $this->villePermis;
    }

    public function setVillePermis(?string $villePermis): self
    {
        $this->villePermis = $villePermis;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(?string $nationalite): self
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function getNumCarteVital(): ?string
    {
        return $this->numCarteVital;
    }

    public function setNumCarteVital(?string $numCarteVital): self
    {
        $this->numCarteVital = $numCarteVital;

        return $this;
    }

    public function getPrenom2(): ?string
    {
        return $this->prenom2;
    }

    public function setPrenom2(?string $prenom2): self
    {
        $this->prenom2 = $prenom2;

        return $this;
    }

    public function getSociete(): ?string
    {
        return $this->societe;
    }

    public function setSociete(?string $societe): self
    {
        $this->societe = $societe;

        return $this;
    }

    public function getEmailPerso(): ?string
    {
        return $this->emailPerso;
    }

    public function setEmailPerso(?string $emailPerso): self
    {
        $this->emailPerso = $emailPerso;

        return $this;
    }

    public function getAppartenance(): ?string
    {
        return $this->appartenance;
    }

    public function setAppartenance(?string $appartenance): self
    {
        $this->appartenance = $appartenance;

        return $this;
    }

    public function getContactsUrgence(): ?string
    {
        return $this->contactsUrgence;
    }

    public function setContactsUrgence(?string $contactsUrgence): self
    {
        $this->contactsUrgence = $contactsUrgence;

        return $this;
    }

    public function getTaille(): ?string
    {
        return $this->taille;
    }

    public function setTaille(?string $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    public function getPointure(): ?string
    {
        return $this->pointure;
    }

    public function setPointure(?string $pointure): self
    {
        $this->pointure = $pointure;

        return $this;
    }

    public function getEmeteurPasseport(): ?string
    {
        return $this->emeteurPasseport;
    }

    public function setEmeteurPasseport(?string $emeteurPasseport): self
    {
        $this->emeteurPasseport = $emeteurPasseport;

        return $this;
    }

    public function getCadeauFinAnnee(): ?bool
    {
        return $this->cadeauFinAnnee;
    }

    public function setCadeauFinAnnee(?bool $cadeauFinAnnee): self
    {
        $this->cadeauFinAnnee = $cadeauFinAnnee;

        return $this;
    }

    public function getStatut(): ?array
    {
        return $this->statut;
    }

    public function setStatut(?array $statut): self
    {
        $this->statut = $statut;

        return $this;
    }
}
