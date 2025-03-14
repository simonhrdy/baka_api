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
    #[Groups(['sport:list', 'league:list', 'referee:list', 'game:list'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['sport:list', 'league:list', 'referee:list', 'game:list'])]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: League::class, mappedBy: 'sport', cascade: ['persist', 'remove'])]
    private Collection $leagues;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['sport:list', 'league:list', 'referee:list'])]
    private ?string $img_src = null;

    #[ORM\Column(length: 255)]
    #[Groups(['sport:list', 'league:list', 'referee:list', 'game:list'])]
    private ?string $url = null;

    public function __construct()
    {
        $this->leagues = new ArrayCollection();
    }

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

    public function getImgSrc(): ?string
    {
        return $this->img_src;
    }

    public function setImgSrc(?string $img_src): static
    {
        $this->img_src = $img_src;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;
        $withoutAccents = str_replace(
            ['á', 'č', 'ě', 'é', 'í', 'ň', 'ó', 'ř', 'š', 'ť', 'ú', 'ů', 'ž'],
            ['a', 'c', 'e', 'e', 'i', 'n', 'o', 'r', 's', 't', 'u', 'u', 'z'],
            $dto->name
        );

        $convertedText = strtolower(str_replace(' ', '-', $withoutAccents));

        if (str_ends_with($convertedText, '?')) {
            $convertedText = rtrim($convertedText, '?');
        }

        return $this;
    }

    public function getLeagues(): Collection
    {
        return $this->leagues;
    }

    public function addLeague(League $league): self
    {
        if (!$this->leagues->contains($league)) {
            $this->leagues[] = $league;
            $league->setSport($this);
        }

        return $this;
    }

    public function removeLeague(League $league): self
    {
        if ($this->leagues->removeElement($league)) {
            if ($league->getSport() === $this) {
                $league->setSport(null);
            }
        }

        return $this;
    }


}
