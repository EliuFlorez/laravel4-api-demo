<?php
namespace App\Resource\Caching;

use App\Resource\Caching\UserCaching;

class CachingContainer
{

	public function __construct(UserCaching $user)
	{
		$this->user = $user;
	}

	public function user()
	{
		return $this->user;
	}
}