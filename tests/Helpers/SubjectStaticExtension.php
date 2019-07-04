<?php

declare(strict_types=1);

namespace NorseBlue\ObjectFacades\Tests\Helpers;

use NorseBlue\ExtensibleObjects\Contracts\ExtensionMethod;

class SubjectStaticExtension implements ExtensionMethod
{
    public function __invoke(): callable
    {
        return static function (int $num): int {
            return (-1) * $num;
        };
    }
}
