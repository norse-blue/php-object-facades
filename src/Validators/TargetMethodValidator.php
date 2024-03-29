<?php

declare(strict_types=1);

namespace NorseBlue\ObjectFacades\Validators;

use BadMethodCallException;
use NorseBlue\ExtensibleObjects\Contracts\Extensible;
use ReflectionClass;
use ReflectionMethod;

final class TargetMethodValidator
{
    public static function enforce(string $class, string $method, ?bool &$static = false): void
    {
        if (method_exists($class, $method)) {
            $static = self::reflectIsMethodStatic($class, $method);

            return;
        }

        $static = self::extensibleIsMethodStatic($class, $method);
    }

    private static function extensibleIsMethodStatic(string $class, string $method): bool
    {
        if (is_subclass_of($class, Extensible::class) && $class::hasExtensionMethod($method)) {
            return $class::getExtensionMethods()[$method]['static'];
        }

        throw new BadMethodCallException("The method '${method}' does not exist for class '${class}'.");
    }

    private static function reflectIsMethodStatic(string $class, string $method): bool
    {
        $reflection = new ReflectionClass($class);

        return in_array(
            $method,
            array_map(
                static function ($item) {
                    return $item->getName();
                },
                $reflection->getMethods(ReflectionMethod::IS_STATIC)
            ),
            true
        );
    }
}
