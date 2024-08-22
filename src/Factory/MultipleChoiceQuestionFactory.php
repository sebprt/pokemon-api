<?php

namespace App\Factory;

use App\Entity\MultipleChoiceQuestion;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

final class MultipleChoiceQuestionFactory extends PersistentProxyObjectFactory
{
    public static function class(): string
    {
        return MultipleChoiceQuestion::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'label' => self::faker()->text(255),
            'choices' => ChoiceFactory::createRange(1, 5),
        ];
    }
}
