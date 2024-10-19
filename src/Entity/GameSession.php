<?php

namespace App\Entity;

use App\Repository\GameSessionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: GameSessionRepository::class)]
class GameSession
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private ?Uuid $id = null;

    #[ORM\ManyToOne(inversedBy: 'sessions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?Game $game = null;

    #[ORM\Column(options: [
        'default' => 0,
    ])]
    #[Assert\NotNull, Assert\PositiveOrZero]
    private ?int $score = null;

    #[ORM\Column(nullable: false)]
    private ?\DateTimeImmutable $startedAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $endedAt = null;

    #[ORM\Column]
    private ?bool $isCompleted = null;

    #[ORM\Column]
    #[Assert\NotNull, Assert\Positive]
    private ?int $questionsAnswered = null;

    #[ORM\Column]
    #[Assert\NotNull, Assert\PositiveOrZero]
    private ?int $correctAnswers = null;

    #[ORM\Column]
    #[Assert\NotNull]
    private ?float $accuracy = null;

    #[ORM\Column]
    #[Assert\NotNull, Assert\PositiveOrZero]
    private ?int $currentStreak = null;

    #[ORM\Column]
    #[Assert\NotNull, Assert\PositiveOrZero]
    private ?int $maxStreak = null;

    #[ORM\Column]
    private ?int $earnedExperience = null;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): static
    {
        $this->game = $game;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): static
    {
        $this->score = $score;

        return $this;
    }

    public function getStartedAt(): ?\DateTimeImmutable
    {
        return $this->startedAt;
    }

    public function setStartedAt(\DateTimeImmutable $startedAt): static
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    public function getEndedAt(): ?\DateTimeImmutable
    {
        return $this->endedAt;
    }

    public function setEndedAt(?\DateTimeImmutable $endedAt): static
    {
        $this->endedAt = $endedAt;

        return $this;
    }

    public function getIsCompleted(): ?bool
    {
        return $this->isCompleted;
    }

    public function setIsCompleted(bool $isCompleted): static
    {
        $this->isCompleted = $isCompleted;

        return $this;
    }

    public function getQuestionsAnswered(): ?int
    {
        return $this->questionsAnswered;
    }

    public function setQuestionsAnswered(int $questionsAnswered): static
    {
        $this->questionsAnswered = $questionsAnswered;

        return $this;
    }

    public function getCorrectAnswers(): ?int
    {
        return $this->correctAnswers;
    }

    public function setCorrectAnswers(int $correctAnswers): static
    {
        $this->correctAnswers = $correctAnswers;

        return $this;
    }

    public function getAccuracy(): ?float
    {
        return $this->accuracy;
    }

    public function setAccuracy(float $accuracy): static
    {
        $this->accuracy = $accuracy;

        return $this;
    }

    public function getCurrentStreak(): ?int
    {
        return $this->currentStreak;
    }

    public function setCurrentStreak(int $currentStreak): static
    {
        $this->currentStreak = $currentStreak;

        return $this;
    }

    public function getMaxStreak(): ?int
    {
        return $this->maxStreak;
    }

    public function setMaxStreak(int $maxStreak): static
    {
        $this->maxStreak = $maxStreak;

        return $this;
    }

    public function getEarnedExperience(): ?int
    {
        return $this->earnedExperience;
    }

    public function setEarnedExperience(int $earnedExperience): static
    {
        $this->earnedExperience = $earnedExperience;

        return $this;
    }
}
