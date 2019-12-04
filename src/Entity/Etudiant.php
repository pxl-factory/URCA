<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EtudiantRepository")
 */
class Etudiant extends User
{
    

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $classe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $placeExam;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $anneeMaster;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Bulletin", mappedBy="etudiant")
     */
    private $bulletins;

    public function __construct()
    {
        $this->bulletins = new ArrayCollection();
    }

    

    public function getClasse(): ?string
    {
        return $this->classe;
    }

    public function setClasse(string $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    public function getPlaceExam(): ?string
    {
        return $this->placeExam;
    }

    public function setPlaceExam(string $placeExam): self
    {
        $this->placeExam = $placeExam;

        return $this;
    }

    public function getAnneeMaster(): ?\DateTimeInterface
    {
        return $this->anneeMaster;
    }

    public function setAnneeMaster(string $anneeMaster): self
    {
        $this->anneeMaster = $anneeMaster;

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
            $bulletin->setEtudiant($this);
        }

        return $this;
    }

    public function removeBulletin(Bulletin $bulletin): self
    {
        if ($this->bulletins->contains($bulletin)) {
            $this->bulletins->removeElement($bulletin);
            // set the owning side to null (unless already changed)
            if ($bulletin->getEtudiant() === $this) {
                $bulletin->setEtudiant(null);
            }
        }

        return $this;
    }
}
