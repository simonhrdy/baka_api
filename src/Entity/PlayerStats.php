<?php

namespace App\Entity;

use App\Repository\PlayerStatsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayerStatsRepository::class)]
class PlayerStats
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Player $player_id = null;

    #[ORM\Column(nullable: true)]
    private ?array $parametrs = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayerId(): ?Player
    {
        return $this->player_id;
    }

    public function setPlayerId(?Player $player_id): static
    {
        $this->player_id = $player_id;

        return $this;
    }

    public function getParametrs(): ?array
    {
        return $this->parametrs;
    }

    public function setParametrs(?array $parametrs): static
    {
        $this->parametrs = $parametrs;

        return $this;
    }
}
