<?php

declare(strict_types=1);

namespace NorseBlue\ObjectFacades\Validators;

use NorseBlue\ObjectFacades\Exceptions\InvalidFacadeTargetClassException;

final class TargetClassValidator
{
    public static function enforce(string $class): void
    {
        if (!is_string($class) || $class === '' || !class_exists($class)) {
            throw new InvalidFacadeTargetClassException('A valid facade concrete class has not been set.');
        }
    }
}
