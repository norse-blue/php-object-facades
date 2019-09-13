<?php

declare(strict_types=1);

namespace NorseBlue\ObjectFacades\Tests\Helpers\Facades;

use NorseBlue\ObjectFacades\Facade;
use NorseBlue\ObjectFacades\Tests\Helpers\Objects\Subject;

/**
 * @method static int mult(int $value, int $offset, int $operand = 2)
 * @method static int swapSign(int $num, int $offset)
 * @method static int sum(int $a, int $offset, int $b)
 * @method static int pow(int $value, int $offset, int $exp)
 * @method static string text(int $value, int $offset)
 */
class SubjectCompleteFacade extends Facade
{
    protected static $target_class = Subject::class;
}
