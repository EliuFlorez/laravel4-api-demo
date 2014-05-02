<?php
namespace App\Repository;

use Illuminate\Support\ServiceProvider;
use App\Repository\Account\Account;
use App\Repository\Account\EloquentAccountRepository;
use App\Repository\Account\EventDecorator as AccountEventDecorator;
use App\Repository\User\User;
use App\Repository\User\EloquentUserRepository;
use App\Repository\User\EventDecorator as UserEventDecorator;

use App\Repository\Account\ValidatorDecorator as AccountValidatorDecorator;
use App\Repository\User\ValidatorDecorator as UserValidatorDecorator;

use App\Validator\AccountValidator;
use App\Validator\UserValidator;

/**
 * Class RepositoryServiceProvider
 * @package App\Repository
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
class RepositoryServiceProvider extends ServiceProvider
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
        $this->registerAccountRepository();
        $this->registerUserRepository();
    }

    /**
     * Register Account Repository
     */
    public function registerAccountRepository()
    {
        // Register a single instance into the app container
        $this->app['repository.account'] = $this->app->share(function ($app) {

            //Instantiate the resource repository
            $repository = new EloquentAccountRepository(new Account());

            //Instantiate the validator
            $validator = new AccountValidatorDecorator($repository, new AccountValidator());

            //Return the latest decorator instance
            return new AccountEventDecorator($validator, $app['events']);
        });

        //
        $this->app->bind('App\Repository\Account\AccountRepository', function ($app) {
            return $app['repository.account'];
        });
    }

    /**
     * Register User Repository
     */
    public function registerUserRepository()
    {
        // Register a single instance into the app container
        $this->app['repository.user'] = $this->app->share(function ($app) {

            //Instantiate the resource repository
            $repository = new EloquentUserRepository(new User());

            //Instantiate the validator
            $validator = new UserValidatorDecorator($repository, new UserValidator());

            //Return the latest decorator instance
            return new UserEventDecorator($validator, $app['events']);
        });

        //
        $this->app->bind('App\Repository\User\UserRepository', function ($app) {
            return $app['repository.user'];
        });
    }
}