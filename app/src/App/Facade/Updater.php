<?php
namespace App\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Updater facade class.
 *
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 *        
 */
class Updater extends Facade
{

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'updater';
	}
}