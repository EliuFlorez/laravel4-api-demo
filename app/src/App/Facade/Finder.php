<?php
namespace App\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Finder facade class.
 *
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 *        
 */
class Finder extends Facade
{

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'finder';
	}
}