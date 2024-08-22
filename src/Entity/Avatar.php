<?php

namespace App\Entity;

use App\Repository\AvatarRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AvatarRepository::class)]
class Avatar
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private ?Uuid $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotNull, Assert\NotBlank]
    private ?string $name = null;

    #[ORM\Column]
    #[Assert\NotNull, Assert\Positive]
    private ?int $unlockPoints = null;

    #[ORM\Column(options: [
        'default' => false,
    ])]
    #[Assert\Type('boolean')]
    private ?bool $isUnlock = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotNull, Assert\NotBlank, Assert\Url]
    private ?string $url = null;

    public function getId(): ?Uuid
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

    public function getUnlockPoints(): ?int
    {
        return $this->unlockPoints;
    }

    public function setUnlockPoints(int $unlockPoints): static
    {
        $this->unlockPoints = $unlockPoints;

        return $this;
    }

    public function getIsUnlock(): ?bool
    {
        return $this->isUnlock;
    }

    public function setIsUnlock(bool $isUnlock): static
    {
        $this->isUnlock = $isUnlock;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }
}
