<?php

declare(strict_types=1);

namespace NorseBlue\ObjectFacades;

use NorseBlue\ObjectFacades\Resolvers\TargetClassCreateResolver;
use NorseBlue\ObjectFacades\Validators\TargetClassValidator;
use NorseBlue\ObjectFacades\Validators\TargetMethodValidator;

abstract class Facade
{
    /** @var string The target class this facade is for. */
    protected static string $target_class = '';

    /** @var int|null The number of constructor params to use to create the object. */
    protected static ?int $constructor_params = null;

    /** @codeCoverageIgnore */
    final private function __construct()
    {
    }

    /**
     * Handle static method calls.
     *
     * @param array<mixed> $parameters
     *
     * @return mixed
     */
    final public static function __callStatic(string $method, array $parameters)
    {
        $class = static::$target_class;

        TargetClassValidator::enforce($class);
        static::enforceFacadeTargetClassType($class);
        TargetMethodValidator::enforce($class, $method, $static);

        if ($static) {
            return $class::$method(...$parameters);
        }

        $object = TargetClassCreateResolver::resolve($class, $parameters, static::$constructor_params);

        return $object->$method(...$parameters);
    }

    /**
     * Validate the facade class type.
     */
    protected static function enforceFacadeTargetClassType(string $class): void
    {
    }
}
