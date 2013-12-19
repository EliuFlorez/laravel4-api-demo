<?php

namespace App\Resource\Creater;

use App;

class UserCreater implements CreaterInterface
{

	public function __construct()
	{
		$this->user = App::make('App\Repository\UserInterface');
		$this->validator = App::make('App\Validator\UserValidator');
	}

	public function create($data)
	{
		$this->validator->isValidForCreation($data);
		
		$user = $this->user;
		$user->fill($data);
		$user->save();
		
		return $user;
	}
}