<?php

namespace App\Entity;

use App\Repository\TestInputAnswerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestInputAnswerRepository::class)]
class TextInputAnswer extends Answer
{
    #[ORM\Column(length: 255)]
    private ?string $content = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?TextInputQuestion $question = null;

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getQuestion(): ?TextInputQuestion
    {
        return $this->question;
    }

    public function setQuestion(?TextInputQuestion $question): static
    {
        $this->question = $question;

        return $this;
    }
}
