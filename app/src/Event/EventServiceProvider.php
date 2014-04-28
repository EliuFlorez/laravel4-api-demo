<?php

namespace App\Event;

use Illuminate\Support\ServiceProvider;

/**
 * Class EventServiceProvider
 * @package App\Event
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
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