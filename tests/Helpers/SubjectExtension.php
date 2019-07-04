<?php

declare(strict_types=1);

namespace NorseBlue\ObjectFacades\Tests\Helpers;

use NorseBlue\ExtensibleObjects\Contracts\ExtensionMethod;

class SubjectExtension implements ExtensionMethod
{
    public function __invoke(): callable
    {
        return function (int $exp): int {
            return $this->value ^ $exp;
        };
    }
}
