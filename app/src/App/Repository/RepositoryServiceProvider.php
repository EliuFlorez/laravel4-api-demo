<?php
namespace App\Repository;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
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
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('App\Repository\UserInterface', 'App\Repository\Eloquent\User');
		$this->app->bind('App\Repository\PlaceInterface', 'App\Repository\Eloquent\Place');
		$this->app->bind('App\Repository\CheckinInterface', 'App\Repository\Eloquent\Checkin');
	}
}