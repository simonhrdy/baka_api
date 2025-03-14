<?php

namespace App\Entity;

use App\Repository\MatchHasRefereesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MatchHasRefereesRepository::class)]
class MatchHasReferees
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['referee:list'])]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Referee::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Referee $referee = null;

    #[ORM\ManyToOne(targetEntity: Game::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['referee:list'])]
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
