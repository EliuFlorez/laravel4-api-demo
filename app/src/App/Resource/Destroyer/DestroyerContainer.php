<?php
namespace App\Resource\Destroyer;

use App\Resource\Destroyer\UserDestroyer;

class DestroyerContainer
{

	public function __construct(UserDestroyer $user)
	{
		$this->user = $user;
	}

	public function user()
	{
		return $this->user;
	}
}