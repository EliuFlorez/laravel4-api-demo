<?php
namespace App\Resource\Creater;

use App\Resource\Creater\User;

class CreaterContainer
{

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public function user()
	{
		return $this->user;
	}
}