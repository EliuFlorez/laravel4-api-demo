<?php
namespace App\Validator;

use Validator;
use App\Validator\Exceptions\ValidatorException;

/**
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
abstract class AbstractValidator
{

	protected static $rulesForCreation;

	protected static $rulesForUpdate;

	public function validate($input, $rules)
	{
		$validator = Validator::make($input, $rules);
		
		if ($validator->fails()) {
			throw new ValidatorException($validator);
		}
	}

	public function isValidForCreation($input)
	{
		$this->validate($input, static::$rulesForCreation);
	}

	public function isValidForUpdate($input)
	{
		$this->validate($input, static::$rulesForUpdate);
	}
}