<?php

namespace App\Entity;

use App\Repository\LeagueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: LeagueRepository::class)]
class League
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['league:list', 'game:list', 'country:list', 'season:list'])]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['league:list', 'game:list', 'country:list', 'season:list'])]
    private ?string $assocation = null;

    #[ORM\Column(length: 255)]
    #[Groups(['league:list', 'game:list', 'country:list', 'season:list'])]
    private ?string $name = null;

    #[ORM\ManyToOne(targetEntity: Sport::class, inversedBy: 'leagues')]
    #[Groups(['league:list', 'game:list'])]
    private ?Sport $sport = null;

    /**
     * @var Collection<int, Season>
     */
    #[ORM\OneToMany(targetEntity: Season::class, mappedBy: 'league_id')]
    #[Groups(['league:list'])]
    private Collection $seasons;

    #[ORM\ManyToOne]
    #[Groups(['league:list'])]
    private ?Country $country_id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['league:list'])]
    private ?string $image_src = null;

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

    public function getCountryId(): ?Country
    {
        return $this->country_id;
    }

    public function setCountryId(?Country $country_id): static
    {
        $this->country_id = $country_id;

        return $this;
    }

    public function getSport(): ?Sport
    {
        return $this->sport;
    }

    public function setSport(?Sport $sport): void
    {
        $this->sport = $sport;
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


}
