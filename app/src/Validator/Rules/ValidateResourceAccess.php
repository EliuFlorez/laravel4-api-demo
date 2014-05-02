<?php

namespace App\Validator\Rules;

use App\Repository\User\User;

/**
 * Class ValidateResourceAccess
 * @package App\Validator\Rules
 */
class ValidateResourceAccess
{
    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return bool
     */
    public function validate($attribute, $value, $parameters)
    {
        switch ($attribute) {

            //Account access
            case 'account_id':
                if (!empty($this->user->accounts)) {
                    return $this->user->accounts->has($value);
                }
                break;

            //School access
            case 'school_id':
                if (!empty($this->user->schools)) {
                    return $this->user->schools->has($value);
                }
                break;

            //User access
            case 'user_id':
                // TODO Only the logged user can passe this validation (use for update and delete)
                break;
        }

        return false;
    }
}