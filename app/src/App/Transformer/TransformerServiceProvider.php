<?php
namespace App\Transformer;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Event;

/**
 * TransformerServiceProvider service provider
 */
class TransformerServiceProvider extends ServiceProvider
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
		//
	}
}