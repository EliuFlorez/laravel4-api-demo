<?php

namespace App\Repository\User;

use App\Decorator\AbstractCacheDecorator;

/**
 * Class EventDecorator
 * @package App\Repository\User
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
class CacheDecorator extends AbstractCacheDecorator implements UserRepository
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
        return $this->repository->resetPassword($email, $password, $resetPasswordCode);
    }
}