<?php
namespace App\Repository;

use Illuminate\Support\ServiceProvider;
use App\Repository\User\EloquentUserModel;
use App\Repository\User\EloquentUserRepository;
use App\Repository\User\EventDecorator;
use Event;

/**
 * RepositoryServiceProvider service provider
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
        $this->registerUserRepository();
    }

    /**
     * Register User Repository
     */
    public function registerUserRepository()
    {
        // Register a single instance into the app container
        $this->app['repository.user'] = $this->app->share(function ($app) {

            //Instantiate the league repository
            $repository = new EloquentUserRepository(new EloquentUserModel());

            //Return the latest decorator instance
            return new EventDecorator($repository, $app['events']);
        });

        // When we want to create a new UserRepository, always refer to the shared instance
        // We have do this for performance reason because we don't to instantiate a new repository evert time
        // For now, we can't think this will cause any unwanted behavior
        $this->app->bind('App\Repository\User\UserRepository', function ($app) {
            return $app['repository.user'];
        });
    }
}