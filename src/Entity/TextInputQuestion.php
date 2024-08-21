<?php

namespace App\Entity;

use App\Repository\TextInputQuestionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TextInputQuestionRepository::class)]
class TextInputQuestion extends Question
{
    #[ORM\Column(length: 255)]
    private ?string $correctAnswer = null;

    public function getCorrectAnswer(): ?string
    {
        return $this->correctAnswer;
    }

    public function setCorrectAnswer(string $correctAnswer): static
    {
        $this->correctAnswer = $correctAnswer;

        return $this;
    }
}
