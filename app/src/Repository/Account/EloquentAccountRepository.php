<?php

namespace App\Repository\Account;

use App\Eloquent\AbstractRepository;
use App\Eloquent\CrudableTrait;
use App\Eloquent\PaginableTrait;
use App\Repository\CrudableInterface;
use App\Repository\PaginableInterface;

/**
 * Class EloquentAccountRepository
 * @package App\Repository\Account
 * author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
class EloquentAccountRepository extends AbstractRepository implements AccountRepository, CrudableInterface, PaginableInterface
{
    use CrudableTrait;
    use PaginableTrait;
}