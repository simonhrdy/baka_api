<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CountryRepository::class)]
class Country
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['country:list', 'league:list', 'player:list'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['country:list', 'league:list', 'player:list'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['country:list', 'league:list', 'player:list'])]
    private ?string $short_name = null;


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

    public function getShortName(): ?string
    {
        return $this->short_name;
    }

    public function setShortName(string $short_name): static
    {
        $this->short_name = $short_name;

        return $this;
    }
}
