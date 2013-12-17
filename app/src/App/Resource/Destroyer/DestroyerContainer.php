<?php
namespace App\Resource\Destroyer;

use App\Resource\Destroyer\User;

class DestroyerContainer
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