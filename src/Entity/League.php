<?php

namespace App\Entity;

use App\Repository\LeagueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LeagueRepository::class)]
class League
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $assocation = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToOne(inversedBy: 'league', cascade: ['persist', 'remove'])]
    private ?Country $country_id = null;

    #[ORM\OneToOne(inversedBy: 'league', cascade: ['persist', 'remove'])]
    private ?Sport $sport_id = null;

    /**
     * @var Collection<int, Season>
     */
    #[ORM\OneToMany(targetEntity: Season::class, mappedBy: 'league_id')]
    private Collection $seasons;

    public function __construct()
    {
        $this->seasons = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAssocation(): ?string
    {
        return $this->assocation;
    }

    public function setAssocation(?string $assocation): static
    {
        $this->assocation = $assocation;

        return $this;
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

    public function getCountryId(): ?Country
    {
        return $this->country_id;
    }

    public function setCountryId(?Country $country_id): static
    {
        $this->country_id = $country_id;

        return $this;
    }

    public function getSportId(): ?Sport
    {
        return $this->sport_id;
    }

    public function setSportId(?Sport $sport_id): static
    {
        $this->sport_id = $sport_id;

        return $this;
    }

    /**
     * @return Collection<int, Season>
     */
    public function getSeasons(): Collection
    {
        return $this->seasons;
    }

    public function addSeason(Season $season): static
    {
        if (!$this->seasons->contains($season)) {
            $this->seasons->add($season);
            $season->setLeagueId($this);
        }

        return $this;
    }

    public function removeSeason(Season $season): static
    {
        if ($this->seasons->removeElement($season)) {
            // set the owning side to null (unless already changed)
            if ($season->getLeagueId() === $this) {
                $season->setLeagueId(null);
            }
        }

        return $this;
    }

}
