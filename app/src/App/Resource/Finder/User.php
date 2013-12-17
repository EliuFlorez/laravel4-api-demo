<?php

namespace App\Resource\Finder;

use App;

class User implements FinderInterface
{
	
	public function __construct()
	{
		$this->user = App::make('App\Repository\UserInterface');
	}
	
	public function find($id){
		return $this->user->find($id);
	}
	
	public function findForIndex()
	{
		return $this->user->take(200)->get();
	}
}