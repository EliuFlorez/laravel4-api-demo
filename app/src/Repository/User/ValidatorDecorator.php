<?php

namespace App\Repository\User;

use App\Decorator\AbstractValidatorDecorator;

/**
 * Class ValidatorDecorator
 * @package App\Repository\User
 * author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
class ValidatorDecorator extends AbstractValidatorDecorator implements UserRepository
{
    /**
     * Generate password reset code
     *
     * @param string $email
     * @param string $redirect_url
     * @return mixed
     */
    public function generateResetPasswordCode($email, $redirect_url)
    {
        $this->validator->isValidForgotPassword(compact('email', 'redirect_url'));

        return $this->repository->generateResetPasswordCode($email, $redirect_url);

    }

    /**
     * Reset user password
     *
     * @param $email
     * @param $password
     * @param $resetPasswordCode
     * @return object
     * @throws \App\Repository\User\Exceptions\UserResetPasswordCodeMismatchException
     */
    public function resetPassword($email, $password, $resetPasswordCode)
    {
        $this->validator->isValidResetPassword(compact('email', 'password', 'resetPasswordCode'));

        return $this->repository->resetPassword($email, $password, $resetPasswordCode);
    }

}