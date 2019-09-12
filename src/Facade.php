<?php

declare(strict_types=1);

namespace NorseBlue\ObjectFacades;

use NorseBlue\ObjectFacades\Resolvers\TargetClassCreateResolver;
use NorseBlue\ObjectFacades\Validators\TargetClassValidator;
use NorseBlue\ObjectFacades\Validators\TargetMethodValidator;

abstract class Facade
{
    /** @var string The target class this facade is for. */
    protected static $target_class = '';

    /** @var int|null The number of constructor params to use to create the object. */
    protected static $constructor_params = null;

    /** @codeCoverageIgnore */
    final private function __construct()
    {
    }

    /**
     * Validate the facade class type.
     *
     * @param string $class
     *
     * @return void
     */
    protected static function enforceFacadeTargetClassType(string $class): void
    {
    }

    /**
     * Handle static method calls.
     *
     * @param string $method
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
}
