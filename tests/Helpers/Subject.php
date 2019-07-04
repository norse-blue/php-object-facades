<?php

declare(strict_types=1);

namespace NorseBlue\ObjectFacades\Tests\Helpers;

use NorseBlue\ExtensibleObjects\Contracts\Extensible;
use NorseBlue\ExtensibleObjects\Traits\HandlesExtensionMethods;

/**
 * @method int pow(int $exp)
 * @method static int swapSign(int $num)
 */
class Subject implements Extensible
{
    use HandlesExtensionMethods;

    /** @var int */
    protected $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public static function sum(int $a, int $b): int
    {
        return $a + $b;
    }

    public function mult(int $operand = 2)
    {
        return $this->value * $operand;
    }

    public function get(): int
    {
        return $this->value;
    }
}
