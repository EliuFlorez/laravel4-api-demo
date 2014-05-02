<?php

namespace App\Repository\User;

use App\Eloquent\AbstractRepository;
use App\Eloquent\CrudableTrait;
use App\Eloquent\PaginableTrait;
use App\Repository\CrudableInterface;
use App\Repository\PaginableInterface;
use App\Repository\User\Exceptions\UserResetPasswordCodeMismatchException;

/**
 * Class EloquentUserRepository
 * @package App\Repository\User
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
class EloquentUserRepository extends AbstractRepository implements UserRepository, CrudableInterface, PaginableInterface
{
    use CrudableTrait;
    use PaginableTrait;

    /**
     * Reset user password
     *
     * @param $email
     * @param $password
     * @param $resetPasswordCode
     * @return User
     * @throws \App\Repository\User\Exceptions\UserResetPasswordCodeMismatchException
     */
    public function resetPassword($email, $password, $resetPasswordCode)
    {
        //Get the user
        $user = $this->getFirstBy('email', $email);

        //If the reset password code match
        if (!empty($resetPasswordCode) AND $resetPasswordCode === $user->reset_password_code) {

            //Reset the password
            $user->password = $password;

            //Delete the reset password code
            $user->reset_password_code = '';

            // Update
            $user->update();

            return $user;

            //Else the reset password code doesn't match
        } else {
            throw new UserResetPasswordCodeMismatchException;
        }
    }

    /**
     * Generate password reset code
     *
     * @param string $email
     * @param string $redirect_url
     * @return User
     */
    public function generateResetPasswordCode($email, $redirect_url)
    {
        //Get the user
        $user = $this->getFirstBy('email', $email);

        //Generate the reset password code
        $user->reset_password_code = \Str::random(42);

        // Update
        $user->update();

        return $user;
    }
}