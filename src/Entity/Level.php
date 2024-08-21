<?php

namespace App\Entity;

use App\Repository\LevelRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LevelRepository::class)]
class Level
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $number = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $requiredPoints = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRequiredPoints(): ?string
    {
        return $this->requiredPoints;
    }

    public function setRequiredPoints(string $requiredPoints): static
    {
        $this->requiredPoints = $requiredPoints;

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
