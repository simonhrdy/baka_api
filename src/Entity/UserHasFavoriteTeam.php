<?php

namespace App\Entity;

use App\Repository\UserHasFavoriteTeamRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserHasFavoriteTeamRepository::class)]
class UserHasFavoriteTeam
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'userHasFavoriteTeams')]
    private ?User $id_user = null;

    #[ORM\ManyToOne(inversedBy: 'userHasFavoriteTeams')]
    private ?Team $team_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?User
    {
        return $this->id_user;
    }

    public function setIdUser(?User $id_user): static
    {
        $this->id_user = $id_user;

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
