<?php

namespace App\Entity;

use App\Repository\RestoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RestoRepository::class)]
class Resto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    private ?string $adresse = null;

    #[ORM\Column]
    private ?int $tel = null;

    #[ORM\Column(length: 50)]
    private ?string $ville = null;

    #[ORM\ManyToOne(inversedBy: 'resto')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Restorateur $restorateur = null;

    #[ORM\OneToMany(mappedBy: 'resto', targetEntity: Reservation::class)]
    private Collection $reservation;

    #[ORM\OneToMany(mappedBy: 'resto', targetEntity: Commenteur::class, orphanRemoval: true)]
    private Collection $commenteur;

    #[ORM\OneToMany(mappedBy: 'resto', targetEntity: Menu::class, orphanRemoval: true)]
    private Collection $menu;

    public function __construct()
    {
        $this->reservation = new ArrayCollection();
        $this->commenteur = new ArrayCollection();
        $this->menu = new ArrayCollection();
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTel(): ?int
    {
        return $this->tel;
    }

    public function setTel(int $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getRestorateur(): ?Restorateur
    {
        return $this->restorateur;
    }

    public function setRestorateur(?Restorateur $restorateur): self
    {
        $this->restorateur = $restorateur;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservation(): Collection
    {
        return $this->reservation;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservation->contains($reservation)) {
            $this->reservation->add($reservation);
            $reservation->setResto($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservation->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getResto() === $this) {
                $reservation->setResto(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Commenteur>
     */
    public function getCommenteur(): Collection
    {
        return $this->commenteur;
    }

    public function addCommenteur(Commenteur $commenteur): self
    {
        if (!$this->commenteur->contains($commenteur)) {
            $this->commenteur->add($commenteur);
            $commenteur->setResto($this);
        }

        return $this;
    }

    public function removeCommenteur(Commenteur $commenteur): self
    {
        if ($this->commenteur->removeElement($commenteur)) {
            // set the owning side to null (unless already changed)
            if ($commenteur->getResto() === $this) {
                $commenteur->setResto(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Menu>
     */
    public function getMenu(): Collection
    {
        return $this->menu;
    }

    public function addMenu(Menu $menu): self
    {
        if (!$this->menu->contains($menu)) {
            $this->menu->add($menu);
            $menu->setResto($this);
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        if ($this->menu->removeElement($menu)) {
            // set the owning side to null (unless already changed)
            if ($menu->getResto() === $this) {
                $menu->setResto(null);
            }
        }

        return $this;
    }
}
