<?php

namespace App\Entity;

use App\Repository\MultipleChoiceAnswerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MultipleChoiceAnswerRepository::class)]
class MultipleChoiceAnswer extends Answer
{
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Choice $choice = null;

    public function getChoice(): ?Choice
    {
        return $this->choice;
    }

    public function setChoice(?Choice $choice): static
    {
        $this->choice = $choice;

        return $this;
    }
}
