<?php

namespace App\Controller;

use App\Entity\Choice;
use App\Entity\Game;
use App\Entity\MultipleChoiceQuestion;
use App\Entity\TextInputQuestion;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

#[AsController]
class AddGameQuestionController extends AbstractController
{
    public function __invoke(Game $game, Request $request): Game
    {
        $content = json_decode($request->getContent());

        if (!property_exists($content, 'type')) {
            throw new BadRequestHttpException('Missing type');
        }

        $question = match ($content->type) {
            'multiple_choice' => $this->createMultipleChoiceQuestion($content),
            'text_input' => (new TextInputQuestion())
                ->setLabel($content->label)
                ->setCorrectAnswer($content->correctAnswer),
            default => throw new \InvalidArgumentException('Unknown type'),
        };

        $game->addQuestion($question);

        return $game;
    }

    private function createMultipleChoiceQuestion(object $content): MultipleChoiceQuestion
    {
        if (!property_exists($content, 'label') || !property_exists($content, 'media') || !property_exists($content, 'choices')) {
            throw new BadRequestHttpException('Missing required fields for multiple choice question');
        }

        $question = new MultipleChoiceQuestion();
        $question->setLabel($content->label)
            ->setMedia($content->media);

        foreach ($content->choices as $choice) {
            if (!property_exists($choice, 'isCorrect')) {
                throw new BadRequestHttpException('Invalid choice format');
            }

            $question->addChoice(
                (new Choice())
                    ->setLabel($choice->label)
                    ->setIsCorrect($choice->isCorrect)
            );
        }

        return $question;
    }
}
