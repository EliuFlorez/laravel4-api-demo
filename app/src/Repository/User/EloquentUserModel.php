<?php
namespace App\Repository\User;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class EloquentUserModel
 * @package App\Repository\User
 */
class EloquentUserModel extends Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Enabled soft delete
     *
     * @var bool
     */
    protected $softDelete = true;

    /**
     * Fillables attributes
     *
     * @var array
     */
    protected $fillable = [];
}