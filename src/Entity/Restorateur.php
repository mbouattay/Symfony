<?php

namespace App\Entity;

use App\Repository\RestorateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RestorateurRepository::class)]
class Restorateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    private ?string $prenom = null;

    #[ORM\Column(length: 50)]
    private ?string $email = null;

    #[ORM\Column(length: 50)]
    private ?string $password = null;

    #[ORM\Column]
    private ?int $cin = null;

    #[ORM\OneToMany(mappedBy: 'restorateur', targetEntity: Resto::class, orphanRemoval: true)]
    private Collection $resto;

    public function __construct()
    {
        $this->resto = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getCin(): ?int
    {
        return $this->cin;
    }

    public function setCin(int $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * @return Collection<int, Resto>
     */
    public function getResto(): Collection
    {
        return $this->resto;
    }

    public function addResto(Resto $resto): self
    {
        if (!$this->resto->contains($resto)) {
            $this->resto->add($resto);
            $resto->setRestorateur($this);
        }

        return $this;
    }

    public function removeResto(Resto $resto): self
    {
        if ($this->resto->removeElement($resto)) {
            // set the owning side to null (unless already changed)
            if ($resto->getRestorateur() === $this) {
                $resto->setRestorateur(null);
            }
        }

        return $this;
    }
}
