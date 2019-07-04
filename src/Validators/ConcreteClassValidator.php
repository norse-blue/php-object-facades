<?php

declare(strict_types=1);

namespace NorseBlue\ObjectFacades\Validators;

use NorseBlue\ObjectFacades\Exceptions\InvalidFacadeConcreteClassException;

final class ConcreteClassValidator
{
    public static function enforce(string $class)
    {
        if (!is_string($class) || $class === '' || !class_exists($class)) {
            throw new InvalidFacadeConcreteClassException('A valid facade concrete class has not been set.');
        }
    }
}
