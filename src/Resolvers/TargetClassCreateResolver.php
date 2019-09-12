<?php

declare(strict_types=1);

namespace NorseBlue\ObjectFacades\Resolvers;

use NorseBlue\CreatableObjects\Contracts\Creatable;
use NorseBlue\CreatableObjects\Resolvers\ConstructorResolver;

final class TargetClassCreateResolver
{
    /**
     * Resolve how to create an object and create it.
     *
     * @param string $class
     * @param array<mixed> $parameters
     * @param int|null $constructor_params
     *
     * @return mixed
     */
    public static function resolve(string $class, array & $parameters, ?int $constructor_params)
    {
        if (is_subclass_of($class, Creatable::class)) {
            /** @var Creatable $class */
            return $class::create($parameters);
        }

        $constructor = ConstructorResolver::resolve($class);

        return new $class(
            ...array_splice(
                $parameters,
                0,
                $constructor_params ?? $constructor->getNumberOfRequiredParameters()
            )
        );
    }
}
