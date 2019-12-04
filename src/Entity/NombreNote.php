<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NombreNoteRepository")
 */
class NombreNote
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbNote;

    /**
     * @ORM\Column(type="float")
     */
    private $ratio1erNote;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeCours", inversedBy="nombreNotes")
     */
    private $typeCours;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Module", inversedBy="nombreNotes")
     */
    private $module;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbNote(): ?int
    {
        return $this->nbNote;
    }

    public function setNbNote(int $nbNote): self
    {
        $this->nbNote = $nbNote;

        return $this;
    }

    public function getRatio1erNote(): ?float
    {
        return $this->ratio1erNote;
    }

    public function setRatio1erNote(float $ratio1erNote): self
    {
        $this->ratio1erNote = $ratio1erNote;

        return $this;
    }

    public function getTypeCours(): ?TypeCours
    {
        return $this->typeCours;
    }

    public function setTypeCours(?TypeCours $typeCours): self
    {
        $this->typeCours = $typeCours;

        return $this;
    }

    public function getModule(): ?Module
    {
        return $this->module;
    }

    public function setModule(?Module $module): self
    {
        $this->module = $module;

        return $this;
    }
}
