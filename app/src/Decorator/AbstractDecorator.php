<?php

namespace App\Decorator;

/**
 * Class AbstractDecorator
 * @package App\Decorator
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
abstract class AbstractDecorator
{
    /**
     * @var mixed
     */
    protected $repository;

    /**
     * Fallback missing method to the repository
     *
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->repository, $name], $arguments);
    }
}