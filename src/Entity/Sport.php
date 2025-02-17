<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SportRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SportRepository::class)]
#[ApiResource]
class Sport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToOne(mappedBy: 'sport_id', cascade: ['persist', 'remove'])]
    private ?Referee $referees = null;

    #[ORM\OneToOne(mappedBy: 'sport_id', cascade: ['persist', 'remove'])]
    private ?League $league = null;

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

    public function getReferees(): ?Referee
    {
        return $this->referees;
    }

    public function setReferees(?Referee $referees): static
    {
        // unset the owning side of the relation if necessary
        if ($referees === null && $this->referees !== null) {
            $this->referees->setSportId(null);
        }

        // set the owning side of the relation if necessary
        if ($referees !== null && $referees->getSportId() !== $this) {
            $referees->setSportId($this);
        }

        $this->referees = $referees;

        return $this;
    }

    public function getLeague(): ?League
    {
        return $this->league;
    }

    public function setLeague(?League $league): static
    {
        // unset the owning side of the relation if necessary
        if ($league === null && $this->league !== null) {
            $this->league->setSportId(null);
        }

        // set the owning side of the relation if necessary
        if ($league !== null && $league->getSportId() !== $this) {
            $league->setSportId($this);
        }

        $this->league = $league;

        return $this;
    }
}
