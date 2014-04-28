<?php

namespace App\Repository\User;

use App\Decorator\AbstractEventDecorator;
use App\Repository\CrudableInterface;

/**
 * Class EventDecorator
 * @package App\Repository\User
 * author Maxime Beaudoin <firalabs@gmail.com>
 */
class EventDecorator extends AbstractEventDecorator implements CrudableInterface
{
    /**
     * The resource name
     *
     * @var string
     */
    protected $resource = 'user';

} 