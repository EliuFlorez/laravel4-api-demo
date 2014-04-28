<?php

namespace App\Event;

use Illuminate\Support\ServiceProvider;

/**
 * Class EventServiceProvider
 * @package App\Event
 */
class EventServiceProvider extends ServiceProvider
{

    /**
     * Register
     */
    public function register()
    {
        //$this->app['events']->subscribe('App\Event\Handler\UserEventHandler');
    }

}