<?php

namespace App\Entity;

use App\Repository\StadiumRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: StadiumRepository::class)]
class Stadium
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['list:list', 'team:list', 'game:list', 'player:list'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['list:list', 'team:list', 'game:list', 'player:list'])]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['list:list', 'team:list', 'game:list', 'player:list'])]
    private ?int $capacity = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(?int $capacity): static
    {
        $this->capacity = $capacity;

        return $this;
    }
}
