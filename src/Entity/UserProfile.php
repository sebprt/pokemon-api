<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity]
class UserProfile
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private ?Uuid $id = null;

    #[ORM\Column]
    private ?int $totalPoints = null;

    #[ORM\Column]
    private ?int $experiencePoints = null;

    #[ORM\Column]
    private ?int $level = null;

    #[ORM\Column]
    private ?int $gamesPlayed = null;

    #[ORM\Column]
    private ?float $accuracyRate = null;

    #[ORM\ManyToOne]
    private ?Avatar $currentAvatar = null;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getTotalPoints(): ?int
    {
        return $this->totalPoints;
    }

    public function setTotalPoints(int $totalPoints): static
    {
        $this->totalPoints = $totalPoints;

        return $this;
    }

    public function getExperiencePoints(): ?int
    {
        return $this->experiencePoints;
    }

    public function setExperiencePoints(int $experiencePoints): static
    {
        $this->experiencePoints = $experiencePoints;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): static
    {
        $this->level = $level;

        return $this;
    }

    public function getGamesPlayed(): ?int
    {
        return $this->gamesPlayed;
    }

    public function setGamesPlayed(int $gamesPlayed): static
    {
        $this->gamesPlayed = $gamesPlayed;

        return $this;
    }

    public function getAccuracyRate(): ?float
    {
        return $this->accuracyRate;
    }

    public function setAccuracyRate(float $accuracyRate): static
    {
        $this->accuracyRate = $accuracyRate;

        return $this;
    }

    public function getCurrentAvatar(): ?Avatar
    {
        return $this->currentAvatar;
    }

    public function setCurrentAvatar(?Avatar $currentAvatar): static
    {
        $this->currentAvatar = $currentAvatar;

        return $this;
    }
}
