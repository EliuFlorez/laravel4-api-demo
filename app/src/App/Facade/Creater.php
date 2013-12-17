<?php
namespace App\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Creater facade class.
 *
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 *        
 */
class Creater extends Facade
{

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'creater';
	}
}