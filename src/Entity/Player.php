<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PlayerRepository::class)]
class Player
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['player:list', 'team:list', 'lineup:list'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['player:list'])]
    private ?\DateTimeInterface $birthdate = null;

    #[ORM\Column(length: 255)]
    #[Groups(['player:list', 'list:list', 'team:list', 'lineup:list'])]
    private ?string $first_name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['player:list', 'list:list', 'team:list', 'lineup:list'])]
    private ?string $last_name = null;

    #[ORM\ManyToOne(inversedBy: 'players')]
    #[Groups(['player:list'])]
    private ?Team $team_id = null;

    #[ORM\ManyToOne(targetEntity: Country::class)]
    #[Groups(['player:list'])]
    private ?Country $country = null;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    #[Groups(['player:list', 'team:list', 'lineup:list'])]
    private ?int $number = null;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    #[Groups(['player:list', 'team:list', 'lineup:list'])]
    private ?string $position = null;

    /**
     * @var Collection<int, PlayerHistory>
     */
    #[ORM\OneToMany(targetEntity: PlayerHistory::class, mappedBy: 'player_id')]
    #[Groups(['player:list'])]
    private Collection $playerHistories;

    public function __construct()
    {
        $this->playerHistories = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(?\DateTimeInterface $birthdate): static
    {
        $this->birthdate = $birthdate;

        return $this;
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

    public function setLastName(string $last_name): static
    {
        $this->last_name = $last_name;

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
            $playerHistory->setPlayerId($this);
        }

        return $this;
    }

    public function removePlayerHistory(PlayerHistory $playerHistory): static
    {
        if ($this->playerHistories->removeElement($playerHistory)) {
            // set the owning side to null (unless already changed)
            if ($playerHistory->getPlayerId() === $this) {
                $playerHistory->setPlayerId(null);
            }
        }

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(?int $number): void
    {
        $this->number = $number;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(?string $position): void
    {
        $this->position = $position;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): void
    {
        $this->country = $country;
    }
}
