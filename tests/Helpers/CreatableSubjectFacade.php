<?php

declare(strict_types=1);

namespace NorseBlue\ObjectFacades\Tests\Helpers;

use NorseBlue\ObjectFacades\Facade;

/**
 * @method static int mult(int $value, int $operand = 2)
 * @method static int swapSign(int $num)
 * @method static int sum(int $a, int $b)
 * @method static int pow(int $value, int $exp)
 */
class CreatableSubjectFacade extends Facade
{
    protected static $target_class = CreatableSubject::class;
}
