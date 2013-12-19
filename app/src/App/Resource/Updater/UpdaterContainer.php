<?php
namespace App\Resource\Updater;

use App\Resource\Updater\UserUpdater;

class UpdaterContainer
{

	public function __construct(UserUpdater $user)
	{
		$this->user = $user;
	}

	public function user()
	{
		return $this->user;
	}
}