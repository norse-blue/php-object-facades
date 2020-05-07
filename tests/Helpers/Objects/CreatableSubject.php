<?php

declare(strict_types=1);

namespace NorseBlue\ObjectFacades\Tests\Helpers\Objects;

use NorseBlue\CreatableObjects\Contracts\Creatable;
use NorseBlue\CreatableObjects\Traits\HandlesObjectCreation;

/**
 * @method int pow(int $exp)
 * @method static int swapSign(int $num)
 */
class CreatableSubject implements Creatable
{
    use HandlesObjectCreation;

    /** @var int */
    protected int $value;

    private function __construct(int $value)
    {
        $this->value = $value;
    }

    public static function sum(int $a, int $b): int
    {
        return $a + $b;
    }

    public function get(): int
    {
        return $this->value;
    }

    public function mult(int $operand = 2)
    {
        return $this->value * $operand;
    }
}
