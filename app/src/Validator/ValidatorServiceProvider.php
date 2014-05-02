<?php

namespace App\Validator;

use App\Validator\Rules\ValidateResourceAccess;
use Illuminate\Support\ServiceProvider;
use ResourceServer;

/**
 * Class ValidatorServiceProvider
 * @package App\Validator
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
class ValidatorServiceProvider extends ServiceProvider
{


    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register
     */
    public function register()
    {
        //
    }

    /**
     * Boot
     *
     * @todo refactor this and try to grab the associate
     * request user elsewhere to prevent multiple database or cache queries
     */
    public function boot()
    {
        //Add account access rules
        $this->app['validator']->extend('has_access', function ($attribute, $value, $parameters) {

            //If the owner type is User
            if (ResourceServer::getOwnerType() == 'user') {

                //Find the user with accounts and schools
                $user = $this->app->make('App\Repository\User\UserRepository')->find(ResourceServer::getOwnerId(), ['accounts']);

                //Generate the rules
                $validator = new ValidateResourceAccess($user);

                //Validate the rules 
                return $validator->validate($attribute, $value, $parameters);
            }

            // IMPORTANT : For now, by default, if your are not a user, the validation will automatically passe
            // Because background job should be able to do everything on every resources
            return true;
        });
    }

}