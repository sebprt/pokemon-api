<?php

namespace App\Entity;

use App\Repository\MultipleChoiceQuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MultipleChoiceQuestionRepository::class)]
class MultipleChoiceQuestion extends Question
{
    /**
     * @var Collection<int, Choice>
     */
    #[ORM\JoinTable]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    #[ORM\InverseJoinColumn(unique: true, onDelete: 'CASCADE')]
    #[ORM\ManyToMany(targetEntity: Choice::class, cascade: ['persist'], orphanRemoval: true)]
    private Collection $choices;

    public function __construct()
    {
        $this->choices = new ArrayCollection();
    }

    /**
     * @return Collection<int, Choice>
     */
    public function getChoices(): Collection
    {
        return $this->choices;
    }

    public function addChoice(Choice $choice): static
    {
        if (!$this->choices->contains($choice)) {
            $this->choices->add($choice);
        }

        return $this;
    }

    public function removeChoice(Choice $choice): static
    {
        $this->choices->removeElement($choice);

        return $this;
    }
}
