<?php

declare(strict_types=1);

namespace NorseBlue\ObjectFacades;

use NorseBlue\ObjectFacades\Resolvers\ConcreteClassCreateResolver;
use NorseBlue\ObjectFacades\Validators\ConcreteClassValidator;
use NorseBlue\ObjectFacades\Validators\ConcreteMethodValidator;

abstract class Facade
{
    /** @var string The concrete class this facade is for. */
    protected static $concrete_class = '';
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
    protected static function enforceFacadeConcreteClassType(string $class): void
    {
    }

    /**
     * Handle static method calls.
     *
     * @param string $method
     * @param array<mixed> $parameters
     *
     * @return mixed
     *
     * @throws \ReflectionException
     */
    final public static function __callStatic(string $method, array $parameters)
    {
        $class = static::$concrete_class;

        ConcreteClassValidator::enforce($class);
        static::enforceFacadeConcreteClassType($class);
        ConcreteMethodValidator::enforce($class, $method, $static);

        if ($static) {
            return $class::$method(...$parameters);
        }

        $object = ConcreteClassCreateResolver::resolve($class, $parameters, static::$constructor_params);

        return $object->$method(...$parameters);
    }
}
