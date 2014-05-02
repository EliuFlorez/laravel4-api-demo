<?php

namespace App\Repository\Account;

use App\Decorator\AbstractCacheDecorator;

/**
 * Class EventDecorator
 * @package App\Repository\Account
 * author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
class CacheDecorator extends AbstractCacheDecorator implements AccountRepository
{
    /**
     * The resource name
     *
     * @var string
     */
    protected $resource = 'account';
}