<?php

namespace App\Entity;

use App\Controller\UserController;
use App\DTO\LoginRequest;
use App\DTO\LoginResponse;
use App\Enum\Role;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Attribute\Ignore;
use OpenApi\Attributes as OA;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    #[Ignore]
    private ?string $password = null;

    #[ORM\Column(type: "json")]
    private array $roles = [];

    /**
     * @var Collection<int, Game>
     */
    #[ORM\OneToMany(targetEntity: Game::class, mappedBy: 'superviser_id')]
    #[Ignore]
    private Collection $games;

    /**
     * @var Collection<int, UserHasFavoriteTeam>
     */
    #[ORM\OneToMany(targetEntity: UserHasFavoriteTeam::class, mappedBy: 'id_user')]
    #[Ignore]
    private Collection $userHasFavoriteTeams;

    public function __construct()
    {
        $this->games = new ArrayCollection();
        $this->userHasFavoriteTeams = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function eraseCredentials(): void
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(Game $game): static
    {
        if (!$this->games->contains($game)) {
            $this->games->add($game);
            $game->setSuperviserId($this);
        }

        return $this;
    }

    public function removeGame(Game $game): static
    {
        if ($this->games->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getSuperviserId() === $this) {
                $game->setSuperviserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserHasFavoriteTeam>
     */
    public function getUserHasFavoriteTeams(): Collection
    {
        return $this->userHasFavoriteTeams;
    }

    public function addUserHasFavoriteTeam(UserHasFavoriteTeam $userHasFavoriteTeam): static
    {
        if (!$this->userHasFavoriteTeams->contains($userHasFavoriteTeam)) {
            $this->userHasFavoriteTeams->add($userHasFavoriteTeam);
            $userHasFavoriteTeam->setIdUser($this);
        }

        return $this;
    }

    public function removeUserHasFavoriteTeam(UserHasFavoriteTeam $userHasFavoriteTeam): static
    {
        if ($this->userHasFavoriteTeams->removeElement($userHasFavoriteTeam)) {
            // set the owning side to null (unless already changed)
            if ($userHasFavoriteTeam->getIdUser() === $this) {
                $userHasFavoriteTeam->setIdUser(null);
            }
        }

        return $this;
    }
}
