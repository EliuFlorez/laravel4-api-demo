<?php

namespace App\Resource\Finder;

use App;

class UserFinder implements FinderInterface
{
	
	public function __construct()
	{
		$this->user = App::make('App\Repository\UserInterface');
	}
	
	public function find($id){
		return $this->user->remember(10, 'user.' . $id)->findOrFail($id);
	}
	
	public function findForIndex()
	{
		return $this->user->remember(10, 'users')->take(200)->get();
	}
}