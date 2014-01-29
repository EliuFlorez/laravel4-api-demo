<?php

namespace App\Validator;

class UserValidator extends AbstractValidator
{

	protected static $rulesForCreation = array(
		'name' => 'required',
		'email' => 'required',
	);

	protected static $rulesForUpdate = array(
		'name' => 'required',
		'email' => 'required',
	);
}