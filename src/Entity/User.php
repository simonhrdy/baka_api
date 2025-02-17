<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Put;
use App\Controller\AuthController;
use App\Controller\AuthControllerAdmin;
use App\DTO\LoginRequest;
use App\DTO\LoginResponse;
use App\Enum\Role;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Operation;
use PhpParser\Builder\Enum_;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Attribute\Ignore;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ApiResource(operations: [
    new Get(),
    new Post(),
    new Put(),
    new Delete(),
    new GetCollection(),
    new Post(uriTemplate: '/login',
        formats: ['json' => ['application/json']],
        controller: AuthController::class,
        shortName: 'Login',
        description: 'Login as user',
        input: LoginRequest::class,
        output: LoginResponse::class,
        name: 'LoginUser',
    )
])]
class User  implements UserInterface, PasswordAuthenticatedUserInterface
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
    private ?string $password = null;

    #[ORM\Column(enumType: Role::class)]
    private Role $role;

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

    public function getRole(): Role
    {
        return $this->role;
    }

    public function setRole(Role $role): self
    {
        $this->role = $role;
        return $this;
    }

    public function getRoles(): array
    {
        return [$this->role->value];
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
