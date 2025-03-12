<?php

namespace App\Entity;

use App\Repository\RefereesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: RefereesRepository::class)]
class Referee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['referee:list'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['referee:list'])]
    private ?string $first_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['referee:list'])]
    private ?string $last_name = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): static
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(?string $last_name): static
    {
        $this->last_name = $last_name;

        return $this;
    }
}
