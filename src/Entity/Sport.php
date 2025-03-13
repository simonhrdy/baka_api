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

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['sport:list', 'league:list', 'referee:list'])]
    private ?string $img_src = null;


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

    public function getImgSrc(): ?string
    {
        return $this->img_src;
    }

    public function setImgSrc(?string $img_src): static
    {
        $this->img_src = $img_src;

        return $this;
    }
}
