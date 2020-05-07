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
     * @param array<mixed> $parameters
     *
     * @return mixed
     */
    public static function resolve(string $class, array &$parameters, ?int $constructor_params)
    {
        $params = self::prepareParameters($class, $parameters, $constructor_params);

        if (is_subclass_of($class, Creatable::class)) {
            return $class::create(...$params);
        }

        return new $class(...$params);
    }

    /**
     * Prepare the parameters for constructor call.
     *
     * @param array<mixed> $parameters
     *
     * @return array<mixed>
     */
    private static function prepareParameters(string $class, array &$parameters, ?int $constructor_params): array
    {
        if ($constructor_params === null) {
            $params = ConstructorResolver::splitParamsForConstructor($class, $parameters);
            $params = array_merge($params['required'], $params['optional']);
        } else {
            $params = array_slice($parameters, 0, $constructor_params);
        }

        $parameters = array_slice($parameters, count($params));

        return $params;
    }
}
