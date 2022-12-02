<?php

namespace App\Entity;

use App\Repository\CommenteurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommenteurRepository::class)]
class Commenteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    private ?string $disc = null;

    #[ORM\ManyToOne(inversedBy: 'commenteur')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Resto $resto = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDisc(): ?string
    {
        return $this->disc;
    }

    public function setDisc(string $disc): self
    {
        $this->disc = $disc;

        return $this;
    }

    public function getResto(): ?Resto
    {
        return $this->resto;
    }

    public function setResto(?Resto $resto): self
    {
        $this->resto = $resto;

        return $this;
    }
}
