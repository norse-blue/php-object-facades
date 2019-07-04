<?php

declare(strict_types=1);

namespace NorseBlue\ObjectFacades\Validators;

use BadMethodCallException;
use NorseBlue\ExtensibleObjects\Contracts\Extensible;
use ReflectionClass;
use ReflectionMethod;

final class ConcreteMethodValidator
{
    public static function enforce(string $class, string $method, ?bool &$static = false): void
    {
        if (
            !($is_method = method_exists($class, $method))
            && !is_subclass_of($class, Extensible::class)
            && !$class::hasExtensionMethod($method)
        ) {
            throw new BadMethodCallException("The method '$method' does not exist for class '$class'.");
        }

        if ($is_method) {
            $reflection = new ReflectionClass($class);
            $static = in_array(
                $method,
                array_map(
                    static function ($item) {
                        /** @var ReflectionMethod $item */
                        return $item->getName();
                    },
                    $reflection->getMethods(ReflectionMethod::IS_STATIC)
                )
            );

            return;
        }

        /** @var Extensible $class */
        $static = $class::getExtensionMethods()[$method]['static'];
    }
}
