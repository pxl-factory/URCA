<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ModuleRepository")
 */
class Module
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UE", inversedBy="modules")
     */
    private $UE;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\TypeCours", mappedBy="modules")
     */
    private $typeCours;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Note", mappedBy="module")
     */
    private $notes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NombreNote", mappedBy="module")
     */
    private $nombreNotes;

    public function __construct()
    {
        $this->typeCours = new ArrayCollection();
        $this->notes = new ArrayCollection();
        $this->nombreNotes = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getUE(): ?UE
    {
        return $this->UE;
    }

    public function setUE(?UE $UE): self
    {
        $this->UE = $UE;

        return $this;
    }

    /**
     * @return Collection|TypeCours[]
     */
    public function getTypeCours(): Collection
    {
        return $this->typeCours;
    }

    public function addTypeCour(TypeCours $typeCour): self
    {
        if (!$this->typeCours->contains($typeCour)) {
            $this->typeCours[] = $typeCour;
            $typeCour->addModule($this);
        }

        return $this;
    }

    public function removeTypeCour(TypeCours $typeCour): self
    {
        if ($this->typeCours->contains($typeCour)) {
            $this->typeCours->removeElement($typeCour);
            $typeCour->removeModule($this);
        }

        return $this;
    }

    /**
     * @return Collection|Note[]
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Note $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes[] = $note;
            $note->setModule($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->contains($note)) {
            $this->notes->removeElement($note);
            // set the owning side to null (unless already changed)
            if ($note->getModule() === $this) {
                $note->setModule(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|NombreNote[]
     */
    public function getNombreNotes(): Collection
    {
        return $this->nombreNotes;
    }

    public function addNombreNote(NombreNote $nombreNote): self
    {
        if (!$this->nombreNotes->contains($nombreNote)) {
            $this->nombreNotes[] = $nombreNote;
            $nombreNote->setModule($this);
        }

        return $this;
    }

    public function removeNombreNote(NombreNote $nombreNote): self
    {
        if ($this->nombreNotes->contains($nombreNote)) {
            $this->nombreNotes->removeElement($nombreNote);
            // set the owning side to null (unless already changed)
            if ($nombreNote->getModule() === $this) {
                $nombreNote->setModule(null);
            }
        }

        return $this;
    }
}
