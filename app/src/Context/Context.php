<?php

namespace App\Context;

use App\Repository\User\User;

/**
 * Class Context
 * @package App\Context
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
class Context
{

    /**
     * The current user
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $user;

    /**
     * Set the user
     *
     * @param \Illuminate\Support\Collection $user
     * @return mixed
     */
    public function set(User $user)
    {
        $this->user = $user;
    }

    /**
     * Check to see if the user has been set
     *
     * @return boolean
     */
    public function has()
    {
        if ($this->user) return true;

        return false;
    }

    /**
     * Get the user identifier
     *
     * @return array
     */
    public function accountIds()
    {
        $ids = [];

        foreach ($this->user->accounts as $account) {
            $ids[] = $account->id;
        }

        return $ids;
    }

    /**
     * Get the user column
     *
     * @return string
     */
    public function accountColumn()
    {
        return 'account_id';
    }

    /**
     * Get the user table name
     *
     * @return string
     */
    public function accountTable()
    {
        return 'accounts';
    }

    /**
     * Get the user model
     *
     * @param \Illuminate\Database\Eloquent\Model
     */
    public function get()
    {
        return $this->user;
    }

}