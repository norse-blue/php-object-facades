---
layout: default
title: Examples
nav_order: 3
permalink: /examples
---

# Examples
{: .no_toc }

## Table of contents
{: .no_toc .text-delta }

1. TOC
{:toc}

---

## Defining a Facade

```php
<?php

declare(strict_type=1);

namespace NorseBlue\ObjectFacades\Examples;

use NorseBlue\ObjectFacades\Facade;

class MyObject
{
    private $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function add(int $operand): int
    {
        return $this->value + $operand;
    }
}

/**
 * @method static int add(int $value, int $operand)
 */
class MyObjectFacade extends Facade
{
    protected static $target_class = MyObject::class;
}
```

## Defining a facade with skipped constructor parameters

```php
<?php

declare(strict_type=1);

namespace NorseBlue\ObjectFacades\Examples;

use NorseBlue\ObjectFacades\Facade;

class MyObject
{
    private $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function add(int $operand): int
    {
        return $this->value + $operand;
    }
}

/**
 * @method static int add(int $value, int $operand)
 */
class MyObjectFacade extends Facade
{
    protected static $target_class = MyObject::class;
}
```
