<?php
namespace App\Resource;

use Illuminate\Support\ServiceProvider;
use App\Resource\Finder\FinderContainer;
use App\Resource\Destroyer\DestroyerContainer;
use App\Resource\Updater\UpdaterContainer;
use App\Resource\Creater\CreaterContainer;
use App\Resource\Caching\CachingContainer;

/**
 * ResourceServiceProvider service provider
 */
class ResourceServiceProvider extends ServiceProvider
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
		$this->registerFinder();
		$this->registerDestroyer();
		$this->registerUpdater();
		$this->registerCreater();
		$this->registerCaching();
	}

	public function registerFinder()
	{
		$this->app['finder'] = new FinderContainer(new Finder\User, new Finder\Place);
	}

	public function registerDestroyer()
	{
		$this->app['destroyer'] = new DestroyerContainer(new Destroyer\User);
	}

	public function registerUpdater()
	{
		$this->app['updater'] = new UpdaterContainer(new Updater\User);
	}

	public function registerCreater()
	{
		$this->app['creater'] = new CreaterContainer(new Creater\User);
	}

	public function registerCaching()
	{
		$this->app['caching'] = new CachingContainer(new Caching\User);
	}
}