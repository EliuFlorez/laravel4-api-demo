<?php
namespace App\Resource\Creater;

use App\Resource\Creater\UserCreater;

class CreaterContainer
{

	public function __construct(UserCreater $user)
	{
		$this->user = $user;
	}

	public function user()
	{
		return $this->user;
	}
}