<?php

declare(strict_types=1);

namespace NorseBlue\ObjectFacades\Resolvers;

use NorseBlue\ExtensibleObjects\Contracts\Creatable;
use NorseBlue\ExtensibleObjects\Resolvers\ClassConstructorAccessibleResolver;

final class ConcreteClassCreateResolver
{
    /**
     * Resolve how to create an object and create it.
     *
     * @param string $class
     * @param array $parameters
     * @param int|null $constructor_params
     *
     * @return mixed
     *
     * @throws \ReflectionException
     */
    public static function resolve(string $class, array & $parameters, ?int $constructor_params)
    {
        if (!ClassConstructorAccessibleResolver::resolve($class, $params)) {
            if (is_subclass_of($class, Creatable::class)) {
                /** @var Creatable $class */
                return $class::create();
            }
        }

        return new $class(...array_splice($parameters, 0, $constructor_params ?? $params['params']));
    }
}
