<?php

namespace App\Entity;

use App\Repository\AvatarRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvatarRepository::class)]
class Avatar
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $unlockPoints = null;

    #[ORM\Column]
    private ?bool $isUnlock = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

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

    public function getUnlockPoints(): ?int
    {
        return $this->unlockPoints;
    }

    public function setUnlockPoints(int $unlockPoints): static
    {
        $this->unlockPoints = $unlockPoints;

        return $this;
    }

    public function isUnlock(): ?bool
    {
        return $this->isUnlock;
    }

    public function setUnlock(bool $isUnlock): static
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
