<?php
namespace App\Resource\Finder;

use App\Resource\Finder\User;
use App\Resource\Finder\Place;

class FinderContainer
{

	public function __construct(User $user, Place $place)
	{
		$this->user = $user;
		$this->place = $place;
	}

	public function user()
	{
		return $this->user;
	}

	public function place()
	{
		return $this->place;
	}
}