<?php
namespace App\Validator;

/**
 * Class UserValidator
 * @package App\Validator
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
class UserValidator extends AbstractValidator
{

    static $rulesForCreation = [
        'email' => 'required|max:64|unique:users|email',
        'password' => 'required|min:8|max:32',
    ];

    static $rulesForUpdate = [
        'email' => 'max:64|unique:users'
    ];

    static $rulesForForgotPassword = [
        'email' => 'required|email',
        'redirect_url' => 'required',
    ];

    static $rulesForResetPassword = [
        'email' => 'required|email',
        'resetPasswordCode' => 'required',
        'password' => 'required',
    ];


    static $rulesForDelete = [
        'user_id' => [
            'required',
            'integer',
            'has_access'
        ]
    ];

    /**
     * Is valid for forgot password
     *
     * @param array $input
     * @return bool
     */
    public function isValidForgotPassword($input)
    {
        return $this->validate($input, static::$rulesForForgotPassword);
    }

    /**
     * Is valid for reset password
     *
     * @param array $input
     * @return bool
     */
    public function isValidResetPassword($input)
    {
        return $this->validate($input, static::$rulesForResetPassword);
    }

}