<?php

namespace App\Entity;
use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Attribute\Ignore;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['team:list', 'game:list', 'player:list'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['team:list', 'game:list', 'player:list', 'list:list'])]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['team:list', 'game:list', 'player:list', 'list:list'])]
    private ?string $surname = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['team:list', 'game:list', 'player:list', 'list:list'])]
    private ?string $coach = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['team:list', 'game:list', 'player:list', 'list:list'])]
    private ?string $image_src = null;

    /**
     * @var Collection<int, Game>
     */
    #[ORM\OneToMany(targetEntity: Game::class, mappedBy: 'home_team_id', orphanRemoval: true)]
    private Collection $games_home;

    /**
     * @var Collection<int, Game>
     */
    #[ORM\OneToMany(targetEntity: Game::class, mappedBy: 'away_team_id', orphanRemoval: true)]
    private Collection $games_away;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['team:list'])]
    private ?string $short_name = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[Groups(['team:list'])]
    private ?Stadium $stadium_id = null;

    /**
     * @var Collection<int, Player>
     */
    #[ORM\OneToMany(targetEntity: Player::class, mappedBy: 'team_id')]
    #[Groups(['team:list'])]
    private Collection $players;

    /**
     * @var Collection<int, PlayerHistory>
     */
    #[ORM\ManyToMany(targetEntity: PlayerHistory::class, mappedBy: 'team_id')]
    #[Ignore]
    private Collection $playerHistories;

    /**
     * @var Collection<int, SeasonHasTeams>
     */
    #[ORM\OneToMany(targetEntity: SeasonHasTeams::class, mappedBy: 'team_id')]
    #[Ignore]
    private Collection $seasonHasTeams;

    /**
     * @var Collection<int, UserHasFavoriteTeam>
     */
    #[ORM\OneToMany(targetEntity: UserHasFavoriteTeam::class, mappedBy: 'team_id')]
    #[Ignore]
    private Collection $userHasFavoriteTeams;

    public function __construct(\Doctrine\Common\Collections\Collection $games_home)
    {
        $this->games_away = new ArrayCollection();
        $this->players = new ArrayCollection();
        $this->playerHistories = new ArrayCollection();
        $this->seasonHasTeams = new ArrayCollection();
        $this->userHasFavoriteTeams = new ArrayCollection();
        $this->games_home = new ArrayCollection();
    }

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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): static
    {
        $this->surname = $surname;

        return $this;
    }


    public function getCoach(): ?string
    {
        return $this->coach;
    }

    public function setCoach(?string $coach): static
    {
        $this->coach = $coach;

        return $this;
    }

    public function getImageSrc(): ?string
    {
        return $this->image_src;
    }

    public function setImageSrc(?string $image_src): static
    {
        $this->image_src = $image_src;

        return $this;
    }

    public function getGamesHome(): Collection
    {
        return $this->games_home;
    }

    public function addGame(Game $game): static
    {
        if (!$this->games_home->contains($game)) {
            $this->games_home->add($game);
            $game->setHomeTeamId($this);
        }

        return $this;
    }

    public function removeGame(Game $game): static
    {
        if ($this->games_home->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getHomeTeamId() === $this) {
                $game->setHomeTeamId(null);
            }
        }

        return $this;
    }

    public function getShortName(): ?string
    {
        return $this->short_name;
    }

    public function setShortName(?string $short_name): static
    {
        $this->short_name = $short_name;

        return $this;
    }

    public function getStadiumId(): ?Stadium
    {
        return $this->stadium_id;
    }

    public function setStadiumId(?Stadium $stadium_id): static
    {
        $this->stadium_id = $stadium_id;

        return $this;
    }

    /**
     * @return Collection<int, Player>
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(Player $player): static
    {
        if (!$this->players->contains($player)) {
            $this->players->add($player);
            $player->setTeamId($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): static
    {
        if ($this->players->removeElement($player)) {
            // set the owning side to null (unless already changed)
            if ($player->getTeamId() === $this) {
                $player->setTeamId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PlayerHistory>
     */
    public function getPlayerHistories(): Collection
    {
        return $this->playerHistories;
    }

    public function addPlayerHistory(PlayerHistory $playerHistory): static
    {
        if (!$this->playerHistories->contains($playerHistory)) {
            $this->playerHistories->add($playerHistory);
            $playerHistory->setTeamId($this);
        }

        return $this;
    }

    public function removePlayerHistory(PlayerHistory $playerHistory): static
    {
        if ($this->playerHistories->removeElement($playerHistory)) {
            // set the owning side to null (unless already changed)
            if ($playerHistory->getTeamId() === $this) {
                $playerHistory->setTeamId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SeasonHasTeams>
     */
    public function getSeasonHasTeams(): Collection
    {
        return $this->seasonHasTeams;
    }

    public function addSeasonHasTeam(SeasonHasTeams $seasonHasTeam): static
    {
        if (!$this->seasonHasTeams->contains($seasonHasTeam)) {
            $this->seasonHasTeams->add($seasonHasTeam);
            $seasonHasTeam->setTeamId($this);
        }

        return $this;
    }

    public function removeSeasonHasTeam(SeasonHasTeams $seasonHasTeam): static
    {
        if ($this->seasonHasTeams->removeElement($seasonHasTeam)) {
            // set the owning side to null (unless already changed)
            if ($seasonHasTeam->getTeamId() === $this) {
                $seasonHasTeam->setTeamId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserHasFavoriteTeam>
     */
    public function getUserHasFavoriteTeams(): Collection
    {
        return $this->userHasFavoriteTeams;
    }

    public function addUserHasFavoriteTeam(UserHasFavoriteTeam $userHasFavoriteTeam): static
    {
        if (!$this->userHasFavoriteTeams->contains($userHasFavoriteTeam)) {
            $this->userHasFavoriteTeams->add($userHasFavoriteTeam);
            $userHasFavoriteTeam->setTeamId($this);
        }

        return $this;
    }

    public function removeUserHasFavoriteTeam(UserHasFavoriteTeam $userHasFavoriteTeam): static
    {
        if ($this->userHasFavoriteTeams->removeElement($userHasFavoriteTeam)) {
            // set the owning side to null (unless already changed)
            if ($userHasFavoriteTeam->getTeamId() === $this) {
                $userHasFavoriteTeam->setTeamId(null);
            }
        }

        return $this;
    }

    public function getGamesAway(): Collection
    {
        return $this->games_away;
    }

    public function setGamesAway(Collection $games_away): void
    {
        $this->games_away = $games_away;
    }
}
