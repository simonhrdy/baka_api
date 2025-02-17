<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MatchHasRefereesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MatchHasRefereesRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['match_read']],
    denormalizationContext: ['groups' => ['match_write']]
)]
class MatchHasReferees
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['match_read'])]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Referee::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['match_read', 'match_write'])]
    private ?Referee $referee = null;

    #[ORM\ManyToOne(targetEntity: Game::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['match_read', 'match_write'])]
    private ?Game $game = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReferee(): ?Referee
    {
        return $this->referee;
    }

    public function setReferee(?Referee $referee): self
    {
        $this->referee = $referee;

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): self
    {
        $this->game = $game;

        return $this;
    }

}
