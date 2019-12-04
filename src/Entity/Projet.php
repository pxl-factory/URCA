<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjetRepository")
 */
class Projet
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
    private $contenu;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDeb;

    /**
     * @ORM\Column(type="integer")
     */
    private $taileGroupeEtudiant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $enseignant;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="monProjet")
     */
    private $etudiantNom;

    public function __construct()
    {
        $this->etudiantNom = new ArrayCollection();
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

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getDateDeb(): ?\DateTimeInterface
    {
        return $this->dateDeb;
    }

    public function setDateDeb(?\DateTimeInterface $dateDeb): self
    {
        $this->dateDeb = $dateDeb;

        return $this;
    }

    public function getTaileGroupeEtudiant(): ?int
    {
        return $this->taileGroupeEtudiant;
    }

    public function setTaileGroupeEtudiant(int $taileGroupeEtudiant): self
    {
        $this->taileGroupeEtudiant = $taileGroupeEtudiant;

        return $this;
    }

    public function getEnseignant(): ?User
    {
        return $this->enseignant;
    }

    public function setEnseignant(?User $enseignant): self
    {
        $this->enseignant = $enseignant;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getEtudiantNom(): Collection
    {
        return $this->etudiantNom;
    }

    public function addEtudiantNom(User $etudiantNom): self
    {
        if (!$this->etudiantNom->contains($etudiantNom)) {
            $this->etudiantNom[] = $etudiantNom;
            $etudiantNom->setMonProjet($this);
        }

        return $this;
    }

    public function removeEtudiantNom(User $etudiantNom): self
    {
        if ($this->etudiantNom->contains($etudiantNom)) {
            $this->etudiantNom->removeElement($etudiantNom);
            // set the owning side to null (unless already changed)
            if ($etudiantNom->getMonProjet() === $this) {
                $etudiantNom->setMonProjet(null);
            }
        }

        return $this;
    }
}
