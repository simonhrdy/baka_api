<?php

namespace App\Entity;

use App\Repository\PlayerHistoryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PlayerHistoryRepository::class)]
class PlayerHistory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['list:list', 'player:list'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['list:list', 'player:list'])]
    private ?\DateTimeInterface $date_of_transfer = null;

    #[ORM\ManyToOne(inversedBy: 'playerHistories')]
    #[Groups(['list:list'])]
    private ?Player $player_id = null;

    #[ORM\ManyToOne(inversedBy: 'playerHistories')]
    #[Groups(['list:list', 'player:list'])]
    private ?Team $team_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateOfTransfer(): ?\DateTimeInterface
    {
        return $this->date_of_transfer;
    }

    public function setDateOfTransfer(\DateTimeInterface $date_of_transfer): static
    {
        $this->date_of_transfer = $date_of_transfer;

        return $this;
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

    public function getTeamId(): ?Team
    {
        return $this->team_id;
    }

    public function setTeamId(?Team $team_id): static
    {
        $this->team_id = $team_id;

        return $this;
    }
}
