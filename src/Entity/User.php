<?php

namespace App\Entity;

use App\Entity\Trait\TimestampableTrait;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    use TimestampableTrait;

    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private ?Uuid $id = null;

    #[ORM\Column(length: 180)]
    #[Assert\NotNull, Assert\NotBlank, Assert\Email]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Assert\NotNull, Assert\NotBlank, Assert\PasswordStrength, Assert\NotCompromisedPassword]
    private ?string $password = null;

    /**
     * @var Collection<int, UserReward>
     */
    #[ORM\JoinTable]
    #[ORM\JoinColumn]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ORM\ManyToMany(targetEntity: UserReward::class, orphanRemoval: true)]
    private Collection $userRewards;

    /**
     * @var Collection<int, UserAvatar>
     */
    #[ORM\JoinTable]
    #[ORM\JoinColumn]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ORM\ManyToMany(targetEntity: UserAvatar::class, orphanRemoval: true)]
    private Collection $userAvatars;

    /**
     * @var Collection<int, GameSession>
     */
    #[ORM\OneToMany(targetEntity: GameSession::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $sessions;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?UserProfile $profile = null;

    public function __construct()
    {
        $this->userRewards = new ArrayCollection();
        $this->userAvatars = new ArrayCollection();
        $this->sessions = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, UserReward>
     */
    public function getUserRewards(): Collection
    {
        return $this->userRewards;
    }

    public function addUserReward(UserReward $userReward): static
    {
        if (!$this->userRewards->contains($userReward)) {
            $this->userRewards->add($userReward);
        }

        return $this;
    }

    public function removeUserReward(UserReward $userReward): static
    {
       $this->userRewards->removeElement($userReward);

        return $this;
    }

    public function getLevel(): ?Level
    {
        return $this->level;
    }

    public function setLevel(?Level $level): static
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return Collection<int, UserAvatar>
     */
    public function getUserAvatars(): Collection
    {
        return $this->userAvatars;
    }

    public function addUserAvatar(UserAvatar $userAvatar): static
    {
        if (!$this->userAvatars->contains($userAvatar)) {
            $this->userAvatars->add($userAvatar);
        }

        return $this;
    }

    public function removeUserAvatar(UserAvatar $userAvatar): static
    {
        $this->userAvatars->removeElement($userAvatar);

        return $this;
    }

    /**
     * @return Collection<int, GameSession>
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    public function addUserGame(GameSession $userGame): static
    {
        if (!$this->sessions->contains($userGame)) {
            $this->sessions->add($userGame);
            $userGame->setUser($this);
        }

        return $this;
    }

    public function removeUserGame(GameSession $userGame): static
    {
        if ($this->sessions->removeElement($userGame)) {
            // set the owning side to null (unless already changed)
            if ($userGame->getUser() === $this) {
                $userGame->setUser(null);
            }
        }

        return $this;
    }

    public function getProfile(): ?UserProfile
    {
        return $this->profile;
    }

    public function setProfile(UserProfile $profile): static
    {
        $this->profile = $profile;

        return $this;
    }
}
