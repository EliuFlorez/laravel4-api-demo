<?php
namespace App\Validator\Exceptions;

/**
 * Validation exception
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 * 
 */
class ValidatorException extends \Exception
{

	/**
	 * Errors object.
	 *
	 * @var Laravel\Messages
	 */
	private $errors;

	/**
	 * Create a new validate exception instance.
	 *
	 * @param Validator $validator        	
	 */
	public function __construct($validator)
	{
		$this->validator = $validator;
		
		parent::__construct(null);
	}

	/**
	 * Get the validator object.
	 */
	public function getValidator()
	{
		return $this->validator;
	}
}