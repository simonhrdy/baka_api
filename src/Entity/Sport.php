<?php

namespace App\Entity;

use App\Repository\SportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SportRepository::class)]
class Sport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['sport:list', 'league:list', 'referee:list'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['sport:list', 'league:list', 'referee:list'])]
    private ?string $name = null;

    #[ORM\OneToOne(mappedBy: 'sport', cascade: ['persist', 'remove'])]
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


    public function getLeague(): ?League
    {
        return $this->league;
    }

    public function setLeague(?League $league): static
    {
        if ($league === null && $this->league !== null) {
            $this->league->setSportId(null);
        }

        if ($league !== null && $league->getSportId() !== $this) {
            $league->setSportId($this);
        }

        $this->league = $league;

        return $this;
    }
}
