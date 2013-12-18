<?php

namespace App\Resource\Destroyer;

use App;

class User implements DestroyerInterface
{

	public function __construct()
	{
		$this->user = App::make('App\Repository\UserInterface');
		$this->validator = App::make('App\Validator\UserValidator');
	}

	public function destroy($id)
	{
		
		$user = $this->user->findOrFail($id);
		$user->delete();
		
		return $user;
	}
}