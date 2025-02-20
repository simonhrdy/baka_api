<?php

namespace App\Entity;

use App\Repository\RefereesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: RefereesRepository::class)]
class Referee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['match_read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $first_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $last_name = null;

    #[ORM\OneToOne(inversedBy: 'referees', cascade: ['persist', 'remove'])]
    private ?Sport $sport_id = null;

    #[ORM\OneToMany(targetEntity: MatchHasReferees::class, mappedBy: 'referee')]
    private Collection $referees;

    public function __construct()
    {
        $this->referees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): static
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(?string $last_name): static
    {
        $this->last_name = $last_name;

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

    public function getReferees(): Collection
    {
        return $this->referees;
    }
}
