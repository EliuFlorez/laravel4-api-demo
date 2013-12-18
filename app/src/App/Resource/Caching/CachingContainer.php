<?php
namespace App\Resource\Caching;

use App\Resource\Caching\User;

class CachingContainer
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