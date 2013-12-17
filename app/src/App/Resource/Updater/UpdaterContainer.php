<?php
namespace App\Resource\Updater;

use App\Resource\Updater\User;

class UpdaterContainer
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