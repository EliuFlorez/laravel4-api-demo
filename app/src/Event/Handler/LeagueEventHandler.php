<?php

namespace App\Event\Handler;

use Illuminate\Events\Dispatcher;
use App\Repository\UserRepository;
use Event;
use Log;

/**
 * Class UserEventHandler
 * @package App\Event\Handler
 */
class UserEventHandler
{

    /**
     * @var \Illuminate\Events\Dispatcher
     */
    public $events;

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher $events
     * @return array
     */
    public function subscribe(Dispatcher $events)
    {
        $this->events = $events;

        $events->listen('user.*', '\App\Event\Handler\UserEventHandler@onUserEvents');
        $events->listen('user.create', '\App\Event\Handler\UserEventHandler@onUserCreate');
        $events->listen('user.update', '\App\Event\Handler\UserEventHandler@onUserUpdate');
        $events->listen('user.delete', '\App\Event\Handler\UserEventHandler@onUserDelete');
        $events->listen('user.restore', '\App\Event\Handler\UserEventHandler@onUserRestore');
    }

    /**
     * Handle user create events.
     *
     * @param UserRepository $user
     */
    public function onUserCreate(UserRepository $user)
    {
        //
    }

    /**
     * Handle user update events.
     *
     * @param UserRepository $user
     */
    public function onUserUpdate(UserRepository $user)
    {
        //
    }

    /**
     * Handle user destroy events.
     *
     * @param UserRepository $user
     */
    public function onUserDelete(UserRepository $user)
    {
        //
    }

    /**
     * Handle user restore events.
     *
     * @param UserRepository $user
     */
    public function onUserRestore(UserRepository $user)
    {
        //
    }

    /**
     * Handle generic events
     *
     * @param UserRepository $user
     */
    public function onUserEvents(UserRepository $user)
    {
        //
        Log::info('[Event fired "' . Event::firing() . '"]');

        //
        Log::info(json_encode($user));
    }

}