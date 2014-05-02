<?php

namespace App\Repository\Account;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class Account
 * @package App\Repository\Account
 * author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
class Account extends Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'accounts';

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
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'settings'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo('App\Repository\User\User', 'user_id');
    }
}