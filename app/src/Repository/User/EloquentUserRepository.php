<?php

namespace App\Repository\User;

use App\Eloquent\AbstractRepository;
use App\Eloquent\CrudableTrait;
use App\Eloquent\PaginableTrait;
use App\Repository\CrudableInterface;
use App\Repository\PaginableInterface;

/**
 * Class EloquentUserRepository
 * @package App\Repository\User
 * author Maxime Beaudoin <firalabs@gmail.com>
 */
class EloquentUserRepository extends AbstractRepository implements UserRepository, CrudableInterface, PaginableInterface
{
    use CrudableTrait;
    use PaginableTrait;
}