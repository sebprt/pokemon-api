<?php

namespace App\Entity;

use App\Repository\LevelRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: LevelRepository::class)]
class Level
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private ?Uuid $id = null;

    #[ORM\Column]
    #[Assert\NotNull, Assert\Positive]
    private ?int $number = null;

    #[ORM\Column(type: Types::INTEGER)]
    #[Assert\NotNull, Assert\Positive]
    private ?int $experienceRequired = null;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getExperienceRequired(): ?int
    {
        return $this->experienceRequired;
    }

    public function setExperienceRequired(int $experienceRequired): static
    {
        $this->experienceRequired = $experienceRequired;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): static
    {
        $this->number = $number;

        return $this;
    }
}
