<?php

namespace App\Entity;

use App\Repository\TestInputAnswerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestInputAnswerRepository::class)]
class TextInputAnswer extends Answer
{
    #[ORM\Column(length: 255)]
    private ?string $content = null;

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }
}
