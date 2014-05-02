<?php

namespace App\Repository\User;

use App\Decorator\AbstractEventDecorator;
use App\Repository\CrudableInterface;

/**
 * Class EventDecorator
 * @package App\Repository\User
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
class EventDecorator extends AbstractEventDecorator implements CrudableInterface, UserRepository
{
    /**
     * The resource name
     *
     * @var string
     */
    protected $resource = 'user';

    /**
     * Generate password reset code
     *
     * @param string $email
     * @param string $redirect_url
     * @return mixed
     */
    public function generateResetPasswordCode($email, $redirect_url)
    {
        $user = $this->repository->generateResetPasswordCode($email, $redirect_url);

        $this->event->fire($this->resource . '.forgot.password', compact('user', 'redirect_url'));

        return $user;
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
        $user = $this->repository->resetPassword($email, $password, $resetPasswordCode);

        $this->event->fire($this->resource . '.reset.password', compact('user'));

        return $user;
    }


} 