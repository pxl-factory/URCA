<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeCoursRepository")
 */
class TypeCours
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
    private $nomCourt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomComplet;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Module", inversedBy="typeCours")
     */
    private $modules;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Note", mappedBy="typeCours")
     */
    private $notes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NombreNote", mappedBy="typeCours")
     */
    private $nombreNotes;

    public function __construct()
    {
        $this->modules = new ArrayCollection();
        $this->notes = new ArrayCollection();
        $this->nombreNotes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCourt(): ?string
    {
        return $this->nomCourt;
    }

    public function setNomCourt(string $nomCourt): self
    {
        $this->nomCourt = $nomCourt;

        return $this;
    }

    public function getNomComplet(): ?string
    {
        return $this->nomComplet;
    }

    public function setNomComplet(string $nomComplet): self
    {
        $this->nomComplet = $nomComplet;

        return $this;
    }

    /**
     * @return Collection|Module[]
     */
    public function getModules(): Collection
    {
        return $this->modules;
    }

    public function addModule(Module $module): self
    {
        if (!$this->modules->contains($module)) {
            $this->modules[] = $module;
        }

        return $this;
    }

    public function removeModule(Module $module): self
    {
        if ($this->modules->contains($module)) {
            $this->modules->removeElement($module);
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
            $note->setTypeCours($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->contains($note)) {
            $this->notes->removeElement($note);
            // set the owning side to null (unless already changed)
            if ($note->getTypeCours() === $this) {
                $note->setTypeCours(null);
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
            $nombreNote->setTypeCours($this);
        }

        return $this;
    }

    public function removeNombreNote(NombreNote $nombreNote): self
    {
        if ($this->nombreNotes->contains($nombreNote)) {
            $this->nombreNotes->removeElement($nombreNote);
            // set the owning side to null (unless already changed)
            if ($nombreNote->getTypeCours() === $this) {
                $nombreNote->setTypeCours(null);
            }
        }

        return $this;
    }
}
