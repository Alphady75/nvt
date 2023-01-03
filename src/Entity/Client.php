<?php

namespace App\Entity;

use App\Entity\Traits\Timestamp;
use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
#[ORM\HasLifecycleCallbacks]
/**
 * @UniqueEntity(fields={"email"}, message="Cette adresse email est déjà liée a un autre compte client")
 */
class Client
{
    use Timestamp;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $prenom;

    #[ORM\Column(type: 'string', length: 40, nullable: true)]
    private $civilite;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $adresse;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $telephone;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $email;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $ville;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Commande::class)]
    private $commandes;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $code;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $num;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $siret;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $apeNaf;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $numTva;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $type;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $raisonSociale;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $groupeClient;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $sousGroupe;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $respFacturation;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $respSaisie;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $decodageAdr;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $adresseValide;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Itineraire::class)]
    private $itineraires;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $statut;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $sectAppartenance;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $sectCompte;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $secteur;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $sectNumSiret;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $facValJournaliere;

    #[ORM\Column(type: 'float', nullable: true)]
    private $factTarif;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $edition;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $editionStartAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $editionEndAt;

    #[ORM\Column(type: 'array', nullable: true)]
    private $factMode = [];

    #[ORM\Column(type: 'text', nullable: true)]
    private $memoTrans;

    #[ORM\Column(type: 'text', nullable: true)]
    private $indFeuilleRoute;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $contFonction;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $contFix;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $contFax;

    #[ORM\Column(type: 'array', nullable: true)]
    private $demandes = [];

    #[ORM\Column(type: 'array', nullable: true)]
    private $mailSms = [];

    #[ORM\Column(type: 'array', nullable: true)]
    private $duplicationSms = [];

    #[ORM\Column(type: 'integer', nullable: true)]
    private $tolAttenteCha;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $tolRetardCha;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $calAttanteCha;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $tolAttenteLiv;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $tolRetardLiv;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $calAttanteLiv;

    #[ORM\ManyToOne(targetEntity: PalEurope::class, inversedBy: 'clients')]
    private $palEurope;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $planChar;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $planCodeChar;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $planSupChar;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $planNbCarChar;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $planVideChar;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $planRefClientChar;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $planSup2Char;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $planNbCar2Char;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $planLiv;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $planLivCode;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $planLivSup;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $planLivNbCar;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $planLivRefClient;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $planLivSup2;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $feuilleChar;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $feuilleCodeChar;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $feuilleSupChar;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $feuilleNbCarChar;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $feuilleVideChar;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $feuilleRefClientChar;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $feuilleLiv;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $feuilleLivCode;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $feuilleLivSup;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $feuilleLivNbCar;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $feuilleLivRefClient;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $comptFourTrCpt;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $comptFourCcMulti;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $comptFourModReg;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $comptFourTypeReg;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $comptFourTypeRegParc;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $comptFourJoursPaiement;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $comptFourActAchat;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $comptFourFactAout;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $comptFourCertifStartAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $comptFourCertifEndAt;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $comptFourRef;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $comptClientTrCpt;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $comptClientCcMulti;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $comptClientModReg;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $comptClientTypeReg;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $comptClientTypeRegParc;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $comptClientJoursPaiement;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $comptClientActVente;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $comptClientFactAout;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $comptClientCertifStartAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $comptClientCertifEndAt;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $comptClientRef;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $relanceNom;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $relanceTel;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $relanceTel2;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $relanceEmail;

    #[ORM\Column(type: 'text', nullable: true)]
    private $relanceMemo;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $relanceJours;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $adresseType;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $adresseCode;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $adresseNom;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $adresseDep;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $adresseRef;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $adresseVille;

    #[ORM\Column(type: 'string', length: 10)]
    private $comptClientCompte;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Facture::class)]
    private $factures;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $actif;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
        $this->itineraires = new ArrayCollection();
        $this->factures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getCivilite(): ?string
    {
        return $this->civilite;
    }

    public function setCivilite(?string $civilite): self
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

    public function __toString()
    {
        return $this->getCode();
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

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
            $commande->setClient($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getClient() === $this) {
                $commande->setClient(null);
            }
        }

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getNum(): ?int
    {
        return $this->num;
    }

    public function setNum(?int $num): self
    {
        $this->num = $num;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(?string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getApeNaf(): ?string
    {
        return $this->apeNaf;
    }

    public function setApeNaf(?string $apeNaf): self
    {
        $this->apeNaf = $apeNaf;

        return $this;
    }

    public function getNumTva(): ?string
    {
        return $this->numTva;
    }

    public function setNumTva(?string $numTva): self
    {
        $this->numTva = $numTva;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getRaisonSociale(): ?string
    {
        return $this->raisonSociale;
    }

    public function setRaisonSociale(?string $raisonSociale): self
    {
        $this->raisonSociale = $raisonSociale;

        return $this;
    }

    public function getGroupeClient(): ?string
    {
        return $this->groupeClient;
    }

    public function setGroupeClient(?string $groupeClient): self
    {
        $this->groupeClient = $groupeClient;

        return $this;
    }

    public function getSousGroupe(): ?string
    {
        return $this->sousGroupe;
    }

    public function setSousGroupe(?string $sousGroupe): self
    {
        $this->sousGroupe = $sousGroupe;

        return $this;
    }

    public function getRespFacturation(): ?string
    {
        return $this->respFacturation;
    }

    public function setRespFacturation(?string $respFacturation): self
    {
        $this->respFacturation = $respFacturation;

        return $this;
    }

    public function getRespSaisie(): ?string
    {
        return $this->respSaisie;
    }

    public function setRespSaisie(?string $respSaisie): self
    {
        $this->respSaisie = $respSaisie;

        return $this;
    }

    public function getDecodageAdr(): ?bool
    {
        return $this->decodageAdr;
    }

    public function setDecodageAdr(?bool $decodageAdr): self
    {
        $this->decodageAdr = $decodageAdr;

        return $this;
    }

    public function getAdresseValide(): ?bool
    {
        return $this->adresseValide;
    }

    public function setAdresseValide(?bool $adresseValide): self
    {
        $this->adresseValide = $adresseValide;

        return $this;
    }

    /**
     * @return Collection|Itineraire[]
     */
    public function getItineraires(): Collection
    {
        return $this->itineraires;
    }

    public function addItineraire(Itineraire $itineraire): self
    {
        if (!$this->itineraires->contains($itineraire)) {
            $this->itineraires[] = $itineraire;
            $itineraire->setClient($this);
        }

        return $this;
    }

    public function removeItineraire(Itineraire $itineraire): self
    {
        if ($this->itineraires->removeElement($itineraire)) {
            // set the owning side to null (unless already changed)
            if ($itineraire->getClient() === $this) {
                $itineraire->setClient(null);
            }
        }

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getSectAppartenance(): ?string
    {
        return $this->sectAppartenance;
    }

    public function setSectAppartenance(?string $sectAppartenance): self
    {
        $this->sectAppartenance = $sectAppartenance;

        return $this;
    }

    public function getSectCompte(): ?string
    {
        return $this->sectCompte;
    }

    public function setSectCompte(?string $sectCompte): self
    {
        $this->sectCompte = $sectCompte;

        return $this;
    }

    public function getSecteur(): ?string
    {
        return $this->secteur;
    }

    public function setSecteur(?string $secteur): self
    {
        $this->secteur = $secteur;

        return $this;
    }

    public function getSectNumSiret(): ?string
    {
        return $this->sectNumSiret;
    }

    public function setSectNumSiret(?string $sectNumSiret): self
    {
        $this->sectNumSiret = $sectNumSiret;

        return $this;
    }

    public function getFacValJournaliere(): ?bool
    {
        return $this->facValJournaliere;
    }

    public function setFacValJournaliere(?bool $facValJournaliere): self
    {
        $this->facValJournaliere = $facValJournaliere;

        return $this;
    }

    public function getFactTarif(): ?float
    {
        return $this->factTarif;
    }

    public function setFactTarif(?float $factTarif): self
    {
        $this->factTarif = $factTarif;

        return $this;
    }

    public function getEdition(): ?string
    {
        return $this->edition;
    }

    public function setEdition(?string $edition): self
    {
        $this->edition = $edition;

        return $this;
    }

    public function getEditionStartAt(): ?\DateTimeInterface
    {
        return $this->editionStartAt;
    }

    public function setEditionStartAt(?\DateTimeInterface $editionStartAt): self
    {
        $this->editionStartAt = $editionStartAt;

        return $this;
    }

    public function getEditionEndAt(): ?\DateTimeInterface
    {
        return $this->editionEndAt;
    }

    public function setEditionEndAt(?\DateTimeInterface $editionEndAt): self
    {
        $this->editionEndAt = $editionEndAt;

        return $this;
    }

    public function getFactMode(): ?array
    {
        return $this->factMode;
    }

    public function setFactMode(?array $factMode): self
    {
        $this->factMode = $factMode;

        return $this;
    }

    public function getMemoTrans(): ?string
    {
        return $this->memoTrans;
    }

    public function setMemoTrans(?string $memoTrans): self
    {
        $this->memoTrans = $memoTrans;

        return $this;
    }

    public function getIndFeuilleRoute(): ?string
    {
        return $this->indFeuilleRoute;
    }

    public function setIndFeuilleRoute(?string $indFeuilleRoute): self
    {
        $this->indFeuilleRoute = $indFeuilleRoute;

        return $this;
    }

    public function getContFonction(): ?string
    {
        return $this->contFonction;
    }

    public function setContFonction(?string $contFonction): self
    {
        $this->contFonction = $contFonction;

        return $this;
    }

    public function getContFix(): ?string
    {
        return $this->contFix;
    }

    public function setContFix(?string $contFix): self
    {
        $this->contFix = $contFix;

        return $this;
    }

    public function getContFax(): ?string
    {
        return $this->contFax;
    }

    public function setContFax(?string $contFax): self
    {
        $this->contFax = $contFax;

        return $this;
    }

    public function getDemandes(): ?array
    {
        return $this->demandes;
    }

    public function setDemandes(?array $demandes): self
    {
        $this->demandes = $demandes;

        return $this;
    }

    public function getMailSms(): ?array
    {
        return $this->mailSms;
    }

    public function setMailSms(?array $mailSms): self
    {
        $this->mailSms = $mailSms;

        return $this;
    }

    public function getDuplicationSms(): ?array
    {
        return $this->duplicationSms;
    }

    public function setDuplicationSms(?array $duplicationSms): self
    {
        $this->duplicationSms = $duplicationSms;

        return $this;
    }

    public function getTolAttenteCha(): ?int
    {
        return $this->tolAttenteCha;
    }

    public function setTolAttenteCha(?int $tolAttenteCha): self
    {
        $this->tolAttenteCha = $tolAttenteCha;

        return $this;
    }

    public function getTolRetardCha(): ?int
    {
        return $this->tolRetardCha;
    }

    public function setTolRetardCha(?int $tolRetardCha): self
    {
        $this->tolRetardCha = $tolRetardCha;

        return $this;
    }

    public function getCalAttanteCha(): ?string
    {
        return $this->calAttanteCha;
    }

    public function setCalAttanteCha(?string $calAttanteCha): self
    {
        $this->calAttanteCha = $calAttanteCha;

        return $this;
    }

    public function getTolRetardLiv(): ?int
    {
        return $this->tolRetardLiv;
    }

    public function setTolRetardLiv(?int $tolRetardLiv): self
    {
        $this->tolRetardLiv = $tolRetardLiv;

        return $this;
    }

    public function getCalAttanteLiv(): ?string
    {
        return $this->calAttanteLiv;
    }

    public function setCalAttanteLiv(?string $calAttanteLiv): self
    {
        $this->calAttanteLiv = $calAttanteLiv;

        return $this;
    }

    public function getTolAttenteLiv(): ?string
    {
        return $this->tolAttenteLiv;
    }

    public function setTolAttenteLiv(?string $tolAttenteLiv): self
    {
        $this->tolAttenteLiv = $tolAttenteLiv;

        return $this;
    }

    public function getPlanChar(): ?bool
    {
        return $this->planChar;
    }

    public function setPlanChar(?bool $planChar): self
    {
        $this->planChar = $planChar;

        return $this;
    }

    public function getPlanCodeChar(): ?bool
    {
        return $this->planCodeChar;
    }

    public function setPlanCodeChar(?bool $planCodeChar): self
    {
        $this->planCodeChar = $planCodeChar;

        return $this;
    }

    public function getPlanSupChar(): ?string
    {
        return $this->planSupChar;
    }

    public function setPlanSupChar(?string $planSupChar): self
    {
        $this->planSupChar = $planSupChar;

        return $this;
    }

    public function getPlanNbCarChar(): ?int
    {
        return $this->planNbCarChar;
    }

    public function setPlanNbCarChar(?int $planNbCarChar): self
    {
        $this->planNbCarChar = $planNbCarChar;

        return $this;
    }

    public function getPlanVideChar(): ?bool
    {
        return $this->planVideChar;
    }

    public function setPlanVideChar(?bool $planVideChar): self
    {
        $this->planVideChar = $planVideChar;

        return $this;
    }

    public function getPlanRefClientChar(): ?bool
    {
        return $this->planRefClientChar;
    }

    public function setPlanRefClientChar(?bool $planRefClientChar): self
    {
        $this->planRefClientChar = $planRefClientChar;

        return $this;
    }

    public function getPlanSup2Char(): ?string
    {
        return $this->planSup2Char;
    }

    public function setPlanSup2Char(?string $planSup2Char): self
    {
        $this->planSup2Char = $planSup2Char;

        return $this;
    }

    public function getPlanNbCar2Char(): ?int
    {
        return $this->planNbCar2Char;
    }

    public function setPlanNbCar2Char(?int $planNbCar2Char): self
    {
        $this->planNbCar2Char = $planNbCar2Char;

        return $this;
    }

    public function getFeuilleLiv(): ?bool
    {
        return $this->feuilleLiv;
    }

    public function setFeuilleLiv(?bool $feuilleLiv): self
    {
        $this->feuilleLiv = $feuilleLiv;

        return $this;
    }

    public function getFeuilleLivCode(): ?bool
    {
        return $this->feuilleLivCode;
    }

    public function setFeuilleLivCode(?bool $feuilleLivCode): self
    {
        $this->feuilleLivCode = $feuilleLivCode;

        return $this;
    }

    public function getFeuilleLivSup(): ?string
    {
        return $this->feuilleLivSup;
    }

    public function setFeuilleLivSup(?string $feuilleLivSup): self
    {
        $this->feuilleLivSup = $feuilleLivSup;

        return $this;
    }

    public function getFeuilleLivNbCar(): ?int
    {
        return $this->feuilleLivNbCar;
    }

    public function setFeuilleLivNbCar(?int $feuilleLivNbCar): self
    {
        $this->feuilleLivNbCar = $feuilleLivNbCar;

        return $this;
    }

    public function getFeuilleLivRefClient(): ?bool
    {
        return $this->feuilleLivRefClient;
    }

    public function setFeuilleLivRefClient(?bool $feuilleLivRefClient): self
    {
        $this->feuilleLivRefClient = $feuilleLivRefClient;

        return $this;
    }

    public function getPlanLivSup2(): ?string
    {
        return $this->planLivSup2;
    }

    public function setPlanLivSup2(?string $planLivSup2): self
    {
        $this->planLivSup2 = $planLivSup2;

        return $this;
    }

    public function getFeuilleChar(): ?bool
    {
        return $this->feuilleChar;
    }

    public function setFeuilleChar(?bool $feuilleChar): self
    {
        $this->feuilleChar = $feuilleChar;

        return $this;
    }

    public function getFeuilleCodeChar(): ?bool
    {
        return $this->feuilleCodeChar;
    }

    public function setFeuilleCodeChar(?bool $feuilleCodeChar): self
    {
        $this->feuilleCodeChar = $feuilleCodeChar;

        return $this;
    }

    public function getFeuilleSupChar(): ?string
    {
        return $this->feuilleSupChar;
    }

    public function setFeuilleSupChar(?string $feuilleSupChar): self
    {
        $this->feuilleSupChar = $feuilleSupChar;

        return $this;
    }

    public function getFeuilleNbCarChar(): ?int
    {
        return $this->feuilleNbCarChar;
    }

    public function setFeuilleNbCarChar(?int $feuilleNbCarChar): self
    {
        $this->feuilleNbCarChar = $feuilleNbCarChar;

        return $this;
    }

    public function getFeuilleVideChar(): ?bool
    {
        return $this->feuilleVideChar;
    }

    public function setFeuilleVideChar(?bool $feuilleVideChar): self
    {
        $this->feuilleVideChar = $feuilleVideChar;

        return $this;
    }

    public function getFeuilleRefClientChar(): ?bool
    {
        return $this->feuilleRefClientChar;
    }

    public function setFeuilleRefClientChar(?bool $feuilleRefClientChar): self
    {
        $this->feuilleRefClientChar = $feuilleRefClientChar;

        return $this;
    }

    public function getPlanLiv(): ?bool
    {
        return $this->planLiv;
    }

    public function setPlanLiv(?bool $planLiv): self
    {
        $this->planLiv = $planLiv;

        return $this;
    }

    public function getPlanLivCode(): ?bool
    {
        return $this->planLivCode;
    }

    public function setPlanLivCode(?bool $planLivCode): self
    {
        $this->planLivCode = $planLivCode;

        return $this;
    }

    public function getPlanLivSup(): ?string
    {
        return $this->planLivSup;
    }

    public function setPlanLivSup(?string $planLivSup): self
    {
        $this->planLivSup = $planLivSup;

        return $this;
    }

    public function getPlanLivNbCar(): ?int
    {
        return $this->planLivNbCar;
    }

    public function setPlanLivNbCar(?int $planLivNbCar): self
    {
        $this->planLivNbCar = $planLivNbCar;

        return $this;
    }

    public function getPlanLivRefClient(): ?bool
    {
        return $this->planLivRefClient;
    }

    public function setPlanLivRefClient(?bool $planLivRefClient): self
    {
        $this->planLivRefClient = $planLivRefClient;

        return $this;
    }

    public function getComptFourTrCpt(): ?string
    {
        return $this->comptFourTrCpt;
    }

    public function setComptFourTrCpt(?string $comptFourTrCpt): self
    {
        $this->comptFourTrCpt = $comptFourTrCpt;

        return $this;
    }

    public function getComptFourCcMulti(): ?bool
    {
        return $this->comptFourCcMulti;
    }

    public function setComptFourCcMulti(?bool $comptFourCcMulti): self
    {
        $this->comptFourCcMulti = $comptFourCcMulti;

        return $this;
    }

    public function getComptFourModReg(): ?string
    {
        return $this->comptFourModReg;
    }

    public function setComptFourModReg(?string $comptFourModReg): self
    {
        $this->comptFourModReg = $comptFourModReg;

        return $this;
    }

    public function getComptFourTypeReg(): ?string
    {
        return $this->comptFourTypeReg;
    }

    public function setComptFourTypeReg(?string $comptFourTypeReg): self
    {
        $this->comptFourTypeReg = $comptFourTypeReg;

        return $this;
    }

    public function getComptFourTypeRegParc(): ?string
    {
        return $this->comptFourTypeRegParc;
    }

    public function setComptFourTypeRegParc(?string $comptFourTypeRegParc): self
    {
        $this->comptFourTypeRegParc = $comptFourTypeRegParc;

        return $this;
    }

    public function getComptFourJoursPaiement(): ?\DateTimeInterface
    {
        return $this->comptFourJoursPaiement;
    }

    public function setComptFourJoursPaiement(?\DateTimeInterface $comptFourJoursPaiement): self
    {
        $this->comptFourJoursPaiement = $comptFourJoursPaiement;

        return $this;
    }

    public function getComptFourActAchat(): ?string
    {
        return $this->comptFourActAchat;
    }

    public function setComptFourActAchat(?string $comptFourActAchat): self
    {
        $this->comptFourActAchat = $comptFourActAchat;

        return $this;
    }

    public function getComptFourFactAout(): ?bool
    {
        return $this->comptFourFactAout;
    }

    public function setComptFourFactAout(?bool $comptFourFactAout): self
    {
        $this->comptFourFactAout = $comptFourFactAout;

        return $this;
    }

    public function getComptFourCertifStartAt(): ?\DateTimeInterface
    {
        return $this->comptFourCertifStartAt;
    }

    public function setComptFourCertifStartAt(?\DateTimeInterface $comptFourCertifStartAt): self
    {
        $this->comptFourCertifStartAt = $comptFourCertifStartAt;

        return $this;
    }

    public function getComptFourCertifEndAt(): ?\DateTimeInterface
    {
        return $this->comptFourCertifEndAt;
    }

    public function setComptFourCertifEndAt(?\DateTimeInterface $comptFourCertifEndAt): self
    {
        $this->comptFourCertifEndAt = $comptFourCertifEndAt;

        return $this;
    }

    public function getComptFourRef(): ?string
    {
        return $this->comptFourRef;
    }

    public function setComptFourRef(?string $comptFourRef): self
    {
        $this->comptFourRef = $comptFourRef;

        return $this;
    }



    public function getComptClientTrCpt(): ?string
    {
        return $this->comptFourTrCpt;
    }

    public function setComptClientTrCpt(?string $comptClientTrCpt): self
    {
        $this->comptClientTrCpt = $comptClientTrCpt;

        return $this;
    }

    public function getComptClientCcMulti(): ?bool
    {
        return $this->comptClientCcMulti;
    }

    public function setComptClientCcMulti(?bool $comptClientCcMulti): self
    {
        $this->comptClientCcMulti = $comptClientCcMulti;

        return $this;
    }

    public function getComptClientModReg(): ?string
    {
        return $this->comptClientModReg;
    }

    public function setComptClientModReg(?string $comptClientModReg): self
    {
        $this->comptClientModReg = $comptClientModReg;

        return $this;
    }

    public function getComptClientTypeReg(): ?string
    {
        return $this->comptClientTypeReg;
    }

    public function setComptClientTypeReg(?string $comptClientTypeReg): self
    {
        $this->comptClientTypeReg = $comptClientTypeReg;

        return $this;
    }

    public function getComptClientTypeRegParc(): ?string
    {
        return $this->comptClientTypeRegParc;
    }

    public function setComptClientTypeRegParc(?string $comptClientTypeRegParc): self
    {
        $this->comptClientTypeRegParc = $comptClientTypeRegParc;

        return $this;
    }

    public function getComptClientJoursPaiement(): ?\DateTimeInterface
    {
        return $this->comptClientJoursPaiement;
    }

    public function setComptClientJoursPaiement(?\DateTimeInterface $comptClientJoursPaiement): self
    {
        $this->comptClientJoursPaiement = $comptClientJoursPaiement;

        return $this;
    }

    public function getComptClientActVente(): ?string
    {
        return $this->comptClientActVente;
    }

    public function setComptClientActVente(?string $comptClientActVente): self
    {
        $this->comptClientActVente = $comptClientActVente;

        return $this;
    }

    public function getComptClientFactAout(): ?bool
    {
        return $this->comptClientFactAout;
    }

    public function setComptClientFactAout(?bool $comptClientFactAout): self
    {
        $this->comptClientFactAout = $comptClientFactAout;

        return $this;
    }

    public function getComptClientCertifStartAt(): ?\DateTimeInterface
    {
        return $this->comptClientCertifStartAt;
    }

    public function setComptClientCertifStartAt(?\DateTimeInterface $comptClientCertifStartAt): self
    {
        $this->comptClientCertifStartAt = $comptClientCertifStartAt;

        return $this;
    }

    public function getComptClientCertifEndAt(): ?\DateTimeInterface
    {
        return $this->comptClientCertifEndAt;
    }

    public function setComptClientCertifEndAt(?\DateTimeInterface $comptClientCertifEndAt): self
    {
        $this->comptClientCertifEndAt = $comptClientCertifEndAt;

        return $this;
    }

    public function getComptClientRef(): ?string
    {
        return $this->comptClientRef;
    }

    public function setComptClientRef(?string $comptClientRef): self
    {
        $this->comptClientRef = $comptClientRef;

        return $this;
    }

    public function getRelanceNom(): ?string
    {
        return $this->relanceNom;
    }

    public function setRelanceNom(?string $relanceNom): self
    {
        $this->relanceNom = $relanceNom;

        return $this;
    }

    public function getRelanceTel(): ?string
    {
        return $this->relanceTel;
    }

    public function setRelanceTel(?string $relanceTel): self
    {
        $this->relanceTel = $relanceTel;

        return $this;
    }

    public function getRelanceTel2(): ?string
    {
        return $this->relanceTel2;
    }

    public function setRelanceTel2(?string $relanceTel2): self
    {
        $this->relanceTel2 = $relanceTel2;

        return $this;
    }

    public function getRelanceEmail(): ?string
    {
        return $this->relanceEmail;
    }

    public function setRelanceEmail(?string $relanceEmail): self
    {
        $this->relanceEmail = $relanceEmail;

        return $this;
    }

    public function getRelanceMemo(): ?string
    {
        return $this->relanceMemo;
    }

    public function setRelanceMemo(?string $relanceMemo): self
    {
        $this->relanceMemo = $relanceMemo;

        return $this;
    }

    public function getRelanceJours(): ?\DateTimeInterface
    {
        return $this->relanceJours;
    }

    public function setRelanceJours(?\DateTimeInterface $relanceJours): self
    {
        $this->relanceJours = $relanceJours;

        return $this;
    }

    public function getAdresseType(): ?string
    {
        return $this->adresseType;
    }

    public function setAdresseType(?string $adresseType): self
    {
        $this->adresseType = $adresseType;

        return $this;
    }

    public function getAdresseCode(): ?string
    {
        return $this->adresseCode;
    }

    public function setAdresseCode(?string $adresseCode): self
    {
        $this->adresseCode = $adresseCode;

        return $this;
    }

    public function getAdresseNom(): ?string
    {
        return $this->adresseNom;
    }

    public function setAdresseNom(?string $adresseNom): self
    {
        $this->adresseNom = $adresseNom;

        return $this;
    }

    public function getAdresseDep(): ?string
    {
        return $this->adresseDep;
    }

    public function setAdresseDep(?string $adresseDep): self
    {
        $this->adresseDep = $adresseDep;

        return $this;
    }

    public function getAdresseRef(): ?string
    {
        return $this->adresseRef;
    }

    public function setAdresseRef(?string $adresseRef): self
    {
        $this->adresseRef = $adresseRef;

        return $this;
    }

    public function getAdresseVille(): ?string
    {
        return $this->adresseVille;
    }

    public function setAdresseVille(?string $adresseVille): self
    {
        $this->adresseVille = $adresseVille;

        return $this;
    }

    public function getComptClientCompte(): ?string
    {
        return $this->comptClientCompte;
    }

    public function setComptClientCompte(string $comptClientCompte): self
    {
        $this->comptClientCompte = $comptClientCompte;

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
            $facture->setClient($this);
        }

        return $this;
    }

    public function removeFacture(Facture $facture): self
    {
        if ($this->factures->removeElement($facture)) {
            // set the owning side to null (unless already changed)
            if ($facture->getClient() === $this) {
                $facture->setClient(null);
            }
        }

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(?bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }
}