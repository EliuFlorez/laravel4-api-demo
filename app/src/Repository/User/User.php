<?php
namespace App\Repository\User;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Hash;

/**
 * Class User
 * @package App\Repository\User
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
class User extends Eloquent
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
    protected $fillable = array(
        'firstname',
        'lastname',
        'email',
        'password'
    );

    /**
     * Mutator to hash the password
     *
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function accounts()
    {
        return $this->belongsToMany('App\Repository\Account\Account', 'users_accounts', 'user_id', 'account_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function schools()
    {
        return $this->belongsToMany('App\Repository\School\School', 'users_schools', 'user_id', 'school_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subjects()
    {
        return $this->belongsToMany('App\Repository\AcademicSubject\AcademicSubject', 'users_academic_subjects', 'user_id', 'academic_subject_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function unavailabilities()
    {
        return $this->hasMany('App\Repository\Unavailability\Unavailability', 'user_id');
    }
}