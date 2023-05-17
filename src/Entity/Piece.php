<?php

namespace App\Entity;

use App\Entity\Traits\Timestamp;
use App\Repository\PieceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PieceRepository::class)]
#[ORM\HasLifecycleCallbacks]
/**
 * @Vich\Uploadable
 */
class Piece
{
    use Timestamp;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    /**
     * @Vich\UploadableField(mapping="pieces_file", fileNameProperty="file")
     * @var File|null
     * @Assert\Image(maxSize="50M", maxSizeMessage="Image trop volumineuse maximum 50Mb")
    **/
    private $documentFile;

    #[ORM\Column(type: 'string', length: 255)]
    private $file;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\ManyToMany(targetEntity: Conducteur::class, mappedBy: 'pieces')]
    #[ORM\JoinColumn(onDelete: "CASCADE")]
    private $conducteurs;

    public function __construct()
    {
        $this->conducteurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $documentFile
     */
    public function setDocumentFile(?File $documentFile = null): void
    {
        $this->documentFile = $documentFile;

        if (null !== $documentFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->setUpdated(new \DateTimeImmutable());
        }
    }

    public function getDocumentFile(): ?File
    {
        return $this->documentFile;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;

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

    /**
     * @return Collection|Conducteur[]
     */
    public function getConducteurs(): Collection
    {
        return $this->conducteurs;
    }

    public function addConducteur(Conducteur $conducteur): self
    {
        if (!$this->conducteurs->contains($conducteur)) {
            $this->conducteurs[] = $conducteur;
            $conducteur->addPiece($this);
        }

        return $this;
    }

    public function removeConducteur(Conducteur $conducteur): self
    {
        if ($this->conducteurs->removeElement($conducteur)) {
            $conducteur->removePiece($this);
        }

        return $this;
    }
}
