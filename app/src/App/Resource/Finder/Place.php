<?php

namespace App\Resource\Finder;

use App;

class Place implements FinderInterface
{
	
	public function __construct()
	{
		$this->place = App::make('App\Repository\PlaceInterface');
	}
	
	public function find($id){
		return $this->place->find($id);
	}
	
	public function findForIndex()
	{
		return $this->place->take(10)->get();
	}
}