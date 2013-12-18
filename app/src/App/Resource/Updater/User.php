<?php

namespace App\Resource\Updater;

use App;

class User implements UpdaterInterface
{

	public function __construct()
	{
		$this->user = App::make('App\Repository\UserInterface');
		$this->validator = App::make('App\Validator\UserValidator');
	}

	public function update($id, $input)
	{
		
		$user = $this->user->findOrFail($id);
		
		$this->validator->isValidForUpdate($input);
		
		$user->fill($input);
		$user->save();
		
		return $user;
	}
}