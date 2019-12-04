<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SemestreRepository")
 */
class Semestre
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
    private $numSemestre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Bulletin", mappedBy="semestre")
     */
    private $bulletins;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UE", mappedBy="semestre")
     */
    private $ues;

    public function __construct()
    {
        $this->bulletins = new ArrayCollection();
        $this->ues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumSemestre(): ?int
    {
        return $this->numSemestre;
    }

    public function setNumSemestre(int $numSemestre): self
    {
        $this->numSemestre = $numSemestre;

        return $this;
    }

    /**
     * @return Collection|Bulletin[]
     */
    public function getBulletins(): Collection
    {
        return $this->bulletins;
    }

    public function addBulletin(Bulletin $bulletin): self
    {
        if (!$this->bulletins->contains($bulletin)) {
            $this->bulletins[] = $bulletin;
            $bulletin->setSemestre($this);
        }

        return $this;
    }

    public function removeBulletin(Bulletin $bulletin): self
    {
        if ($this->bulletins->contains($bulletin)) {
            $this->bulletins->removeElement($bulletin);
            // set the owning side to null (unless already changed)
            if ($bulletin->getSemestre() === $this) {
                $bulletin->setSemestre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UE[]
     */
    public function getUes(): Collection
    {
        return $this->ues;
    }

    public function addUe(UE $ue): self
    {
        if (!$this->ues->contains($ue)) {
            $this->ues[] = $ue;
            $ue->setSemestre($this);
        }

        return $this;
    }

    public function removeUe(UE $ue): self
    {
        if ($this->ues->contains($ue)) {
            $this->ues->removeElement($ue);
            // set the owning side to null (unless already changed)
            if ($ue->getSemestre() === $this) {
                $ue->setSemestre(null);
            }
        }

        return $this;
    }
}
