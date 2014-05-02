<?php

namespace App\Filter;

use App\Context\Context;
use App\Repository\User\UserRepository;
use ResourceServer;

/**
 * Class ContextFilter
 * @package App\Filter
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
class ContextFilter
{
    /**
     * @var \App\Repository\User\UserRepository
     */
    protected $repository;

    /**
     * @var \App\Context\Context
     */
    protected $context;

    /**
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user, Context $context)
    {
        $this->repository = $user;
        $this->context = $context;
    }

    /**
     * @param $route
     * @param $request
     * @param bool $value
     */
    public function filter($route, $request, $value = false)
    {
        //If the owner type is User
        if (ResourceServer::getOwnerType() == 'user') {

            //Find the user with accounts and schools
            $user = $this->repository->find(ResourceServer::getOwnerId(), ['accounts', 'schools']);

            //Set the context
            $this->context->set($user);
        }
    }

    public function getContext()
    {
        return $this->context;
    }
}