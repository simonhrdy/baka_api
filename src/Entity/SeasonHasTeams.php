<?php

namespace App\Entity;

use App\Repository\SeasonHasTeamsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SeasonHasTeamsRepository::class)]
class SeasonHasTeams
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['list:list'])]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['list:list'])]
    private ?int $points = null;

    #[ORM\ManyToOne(inversedBy: 'seasonHasTeams')]
    #[Groups(['list:list'])]
    private ?Season $season_id = null;

    #[ORM\ManyToOne(inversedBy: 'seasonHasTeams')]
    #[Groups(['list:list', 'season:list'])]
    private ?Team $team_id = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(?int $points): static
    {
        $this->points = $points;

        return $this;
    }

    public function getSeasonId(): ?Season
    {
        return $this->season_id;
    }

    public function setSeasonId(?Season $season_id): static
    {
        $this->season_id = $season_id;

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
