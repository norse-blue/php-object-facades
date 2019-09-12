<?php

declare(strict_types=1);

namespace NorseBlue\ObjectFacades\Resolvers;

use NorseBlue\CreatableObjects\Contracts\Creatable;
use NorseBlue\CreatableObjects\Resolvers\ConstructorResolver;

final class TargetClassCreateResolver
{
    /**
     * Prepare the parameters for constructor call.
     *
     * @param $class
     * @param array $parameters
     * @param int|null $constructor_params
     *
     * @return array
     */
    private static function prepareParameters($class, array & $parameters, ?int $constructor_params)
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
        $params = self::prepareParameters($class, $parameters, $constructor_params);

        if (is_subclass_of($class, Creatable::class)) {
            /** @var Creatable $class */
            return $class::create(...$params);
        }

        return new $class(...$params);
    }
}
