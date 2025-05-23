<?php

namespace App\Entity;

use App\Enum\Status;
use App\Repository\GameRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['game:list', 'referee:list', 'team:list', 'player_games:list'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['game:list', 'player_games:list'])]
    private ?Team $home_team_id = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['game:list', 'player_games:list'])]
    private ?Team $away_team_id = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['game:list'])]
    private ?int $lap = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['game:list', 'player_games:list'])]
    private ?array $parametrs = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['game:list', 'player_games:list'])]
    private DateTimeInterface $date_of_game;

    #[ORM\ManyToOne(inversedBy: 'games')]
    #[Groups(['game:list'])]
    private ?User $superviser_id = null;

    #[ORM\Column(type: 'integer', options: ['default' => 0])]
    private int $homePointsAwarded = 0;

    #[ORM\Column(type: 'integer', options: ['default' => 0])]
    private int $awayPointsAwarded = 0;

    #[ORM\OneToMany(targetEntity: MatchHasReferees::class, mappedBy: 'game')]
    #[Groups(['game:list'])]
    private Collection $game;

    #[ORM\ManyToOne(targetEntity: League::class, inversedBy: 'games')]
    #[ORM\JoinColumn(name: 'league_id', referencedColumnName: 'id')]
    #[Groups(['game:list'])]
    private ?League $league_id = null;

    #[ORM\Column(type: 'integer', enumType: Status::class, options: ['default' => 0])]
    #[Groups(['game:list', 'player_games:list'])]
    private Status $status = Status::NOT_STARTED;

    public function __construct()
    {
        $this->game = new ArrayCollection();
    }

    public function getRefereeGames(): Collection
    {
        return $this->game;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHomeTeamId(): ?Team
    {
        return $this->home_team_id;
    }

    public function setHomeTeamId(?Team $home_team_id): static
    {
        $this->home_team_id = $home_team_id;

        return $this;
    }

    public function getAwayTeamId(): ?Team
    {
        return $this->away_team_id;
    }

    public function setAwayTeamId(?Team $away_team_id): static
    {
        $this->away_team_id = $away_team_id;

        return $this;
    }

    public function getLap(): ?int
    {
        return $this->lap;
    }

    public function setLap(?int $lap): static
    {
        $this->lap = $lap;

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

    public function getSuperviserId(): ?User
    {
        return $this->superviser_id;
    }

    public function setSuperviserId(?User $superviser_id): static
    {
        $this->superviser_id = $superviser_id;

        return $this;
    }
    public function getDateOfGame(): DateTimeInterface
    {
        return $this->date_of_game;
    }

    public function setDateOfGame(DateTimeInterface $date_of_game): void
    {
        $this->date_of_game = $date_of_game;
    }

    public function getLeagueId(): ?League
    {
        return $this->league_id;
    }

    public function setLeagueId(?League $league_id): static
    {
        $this->league_id = $league_id;

        return $this;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function setStatus(Status $status): void
    {
        $this->status = $status;
    }

    public function getHomePointsAwarded(): int
    {
        return $this->homePointsAwarded;
    }

    public function setHomePointsAwarded(int $homePointsAwarded): void
    {
        $this->homePointsAwarded = $homePointsAwarded;
    }

    public function getAwayPointsAwarded(): int
    {
        return $this->awayPointsAwarded;
    }

    public function setAwayPointsAwarded(int $awayPointsAwarded): void
    {
        $this->awayPointsAwarded = $awayPointsAwarded;
    }
}
