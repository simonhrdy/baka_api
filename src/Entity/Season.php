<?php

namespace App\Entity;

use App\Repository\SeasonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SeasonRepository::class)]
class Season
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['season:list'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['season:list'])]
    private ?bool $is_active = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['season:list'])]
    private ?\DateTimeInterface $yearEnd = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['season:list'])]
    private ?\DateTimeInterface $yearStart = null;

    #[ORM\ManyToOne(inversedBy: 'seasons')]
    #[Groups(['season:list'])]
    private ?League $league_id = null;

    /**
     * @var Collection<int, SeasonHasTeams>
     */
    #[ORM\OneToMany(targetEntity: SeasonHasTeams::class, mappedBy: 'season_id')]
    #[Groups(['season:list'])]
    private Collection $seasonHasTeams;

    public function __construct()
    {
        $this->seasonHasTeams = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function isActive(): ?bool
    {
        return $this->is_active;
    }

    public function setActive(bool $is_active): static
    {
        $this->is_active = $is_active;

        return $this;
    }

    public function getYearEnd(): ?\DateTimeInterface
    {
        return $this->yearEnd;
    }

    public function setYearEnd(\DateTimeInterface $yearEnd): static
    {
        $this->yearEnd = $yearEnd;

        return $this;
    }

    public function getYearStart(): ?\DateTimeInterface
    {
        return $this->yearStart;
    }

    public function setYearStart(\DateTimeInterface $yearStart): static
    {
        $this->yearStart = $yearStart;

        return $this;
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
            $seasonHasTeam->setSeasonId($this);
        }

        return $this;
    }

    public function removeSeasonHasTeam(SeasonHasTeams $seasonHasTeam): static
    {
        if ($this->seasonHasTeams->removeElement($seasonHasTeam)) {
            // set the owning side to null (unless already changed)
            if ($seasonHasTeam->getSeasonId() === $this) {
                $seasonHasTeam->setSeasonId(null);
            }
        }

        return $this;
    }
}
