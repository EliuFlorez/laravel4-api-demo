<?php

namespace App\Context;

use Illuminate\Support\ServiceProvider;

/**
 * Class ContextServiceProvider
 * @package App\Context
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
class ContextServiceProvider extends ServiceProvider
{

    /**
     * Register
     */
    public function register()
    {
        $this->app['context'] = $this->app->share(function ($app) {
            return new Context();
        });

        $this->app->bind('App\Context\Context', function ($app) {
            return $app['context'];
        });
    }

}