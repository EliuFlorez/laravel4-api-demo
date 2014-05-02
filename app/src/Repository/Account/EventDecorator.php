<?php

namespace App\Repository\Account;

use App\Decorator\AbstractEventDecorator;
use App\Repository\CrudableInterface;

/**
 * Class EventDecorator
 * @package App\Repository\Account
 * author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
class EventDecorator extends AbstractEventDecorator implements CrudableInterface, AccountRepository
{
    /**
     * The resource name
     *
     * @var string
     */
    protected $resource = 'account';

}