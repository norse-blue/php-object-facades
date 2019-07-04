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
class SubjectFacade extends Facade
{
    protected static $concrete_class = Subject::class;
}
