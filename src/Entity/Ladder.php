<?php

namespace App\Entity;

use App\Repository\LadderRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LadderRepository::class)]
class Ladder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'ladders')]
    private ?user $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): static
    {
        $this->user = $user;

        return $this;
    }
}
