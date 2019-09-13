<?php

declare(strict_types=1);

namespace NorseBlue\ObjectFacades\Tests\Helpers\Facades;

use NorseBlue\ObjectFacades\Facade;
use NorseBlue\ObjectFacades\Tests\Helpers\Objects\Subject;

/**
 * @method static int mult(int $value, int $operand = 2)
 * @method static int swapSign(int $num)
 * @method static int sum(int $a, int $b)
 * @method static int pow(int $value, int $exp)
 * @method static string text(int $value)
 */
class SubjectFacade extends Facade
{
    protected static $target_class = Subject::class;

    protected static $constructor_params = 1;
}
