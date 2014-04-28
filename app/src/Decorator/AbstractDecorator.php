<?php

namespace App\Decorator;

/**
 * Class AbstractDecorator
 * @package App\Decorator
 */
abstract class AbstractDecorator
{
    protected $repository;

    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->repository, $name], $arguments);
    }
}