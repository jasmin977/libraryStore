<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Livre::class, mappedBy="categorie")
     */
    private $Livre;

    public function __construct()
    {
        $this->Livre = new ArrayCollection();
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

    /**
     * @return Collection|Livre[]
     */
    public function getLivre(): Collection
    {
        return $this->Livre;
    }

    public function addLivre(Livre $livre): self
    {
        if (!$this->Livre->contains($livre)) {
            $this->Livre[] = $livre;
            $livre->setCategorie($this);
        }

        return $this;
    }

    public function removeLivre(Livre $livre): self
    {
        if ($this->Livre->removeElement($livre)) {
            // set the owning side to null (unless already changed)
            if ($livre->getCategorie() === $this) {
                $livre->setCategorie(null);
            }
        }

        return $this;
    }
}
