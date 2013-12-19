<?php
namespace App\Resource\Finder;

use App\Resource\Finder\UserFinder;
use App\Resource\Finder\PlaceFinder;

class FinderContainer
{

	public function __construct(UserFinder $user, PlaceFinder $place)
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