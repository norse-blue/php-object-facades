---
layout: default
title: Usage
nav_order: 2
permalink: /usage
---

# Usage
{: .no_toc }

## Table of contents
{: .no_toc .text-delta }

1. TOC
{:toc}

---

A Facade allows you to call object instance methods as if they were static. Underneath, the object creation will be handled by the facade (although you need to pass at least the required parameters to actually be able to build the object).

## Defining a Facade

To create a facade for an object, your _base_ class should have a public constructor or implement the `Creatable` interface (and logic). An exception to this is if you only have static methods in your target object (but in that case, you shouldn't be using a facade).

The method calls that the facade can proxy can be the object's own methods and also the registered [extension methods](https://github.com/norse-blue/php-extensible-objects) for an `Extensible` object.

The only requirement for the facade is that it should have the target object class defined.

```php
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

class MyObjectFacade extends Facade
{
    protected static $target_class = MyObject::class;
}
```

[See complete example]({{ site.baseurl }}{% link sections/examples.md %}#defining-a-facade)

## Using a Facade

To use an object's method through a facade, you call the method _statically_ on the facade, prepending the parameters for the object creation to the parameters required by the method.

Expanding on the previous code snippets, one would use the facade as follows:

```php
$result = MyObjectFacade::add(3, 6);
echo $result;
// Outputs: 9
```

As you can see, the facade automatically handles the object creation using the first parameter (`3`) to create the object and the second parmeter (`6`) to call the method on the created object.

## Bypassing constructor optional parameters

Sometimes, for whatever reason, you want a facade to skip an object's constructor optional parameters when creating it and just use the provieded defaults. This can be achieved as follows:

```php
use NorseBlue\ObjectFacades\Facade;

class MyObject
{
    private $value;
    private $optional;

    public function __construct(int $value, string $optional = 'default')
    {
        $this->value = $value;
        $this->optional = $optional;
    }

    public function add(int $operand): int
    {
        return $this->value + $operand;
    }
}

class MyObjectFacade extends Facade
{
    protected static $target_class = MyObject::class;

    protected static $constructor_params = 1;
}
```

[See complete example]({{ site.baseurl }}{% link sections/examples.md %}#defining-a-facade-with-skipped-constructor-parameters)

This will tell the Facade to use just `1` of the provided parameters to build the object, and the rest to pass on to the method. The usage will look like the following:

```php
$result = MyObjectFacade::add(3, 6);
echo $result;
// Outputs: 9
```

The facade call will use the first parameter (`3`) to create the object, and the second parameter (`6`) to use for the method `add` call, skipping the `$optional` parameter from the constructor.

If we hadn't specify the `$constructor_params`, the call would have failed as the facade would have try to build the object using both parameters for the constructor, which would have outputed a type missmatch error.
