<?php
namespace App\Http;

use Illuminate\Support\ServiceProvider;
use App\Http\Response;
use League\Fractal\Manager;

/**
 * HttpServiceProvider service provider
 */
class HttpServiceProvider extends ServiceProvider
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
		// Register response macro
		\Response::macro('api', function ()
		{
			
			// Return the Reponse object
			return new Response(new Manager);
		});
	}
}