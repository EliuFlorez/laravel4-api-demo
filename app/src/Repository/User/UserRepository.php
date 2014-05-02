<?php

namespace App\Repository\User;

/**
 * Interface UserRepository
 * @package App\Repository\User
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
interface UserRepository
{
    /**
     * Generate password reset code
     *
     * @param string $email
     * @param string $redirect_url
     * @return mixed
     */
    public function generateResetPasswordCode($email, $redirect_url);

    /**
     * Reset user password
     *
     * @param $email
     * @param $password
     * @param $resetPasswordCode
     * @return object
     * @throws \App\Repository\User\Exceptions\UserResetPasswordCodeMismatchException
     */
    public function resetPassword($email, $password, $resetPasswordCode);
}