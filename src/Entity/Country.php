<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CountryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CountryRepository::class)]
#[ApiResource]
class Country
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $short_name = null;

    #[ORM\OneToOne(mappedBy: 'country_id', cascade: ['persist', 'remove'])]
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

    public function getShortName(): ?string
    {
        return $this->short_name;
    }

    public function setShortName(string $short_name): static
    {
        $this->short_name = $short_name;

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
            $this->league->setCountryId(null);
        }

        // set the owning side of the relation if necessary
        if ($league !== null && $league->getCountryId() !== $this) {
            $league->setCountryId($this);
        }

        $this->league = $league;

        return $this;
    }
}
