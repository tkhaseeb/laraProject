<?php

namespace App\Traits;

trait SayHelloTrait
{
    public function sayHello(): string
    {
        return "Hello from the trait!";
    }
}