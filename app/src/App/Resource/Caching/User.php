<?php

namespace App\Resource\Caching;

use App;
use Cache;

class User implements CachingInterface
{

	public function change($id = null)
	{
		//Forget or flush the cache of the current resource
		Cache::forget('user.' . $id);
		Cache::forget('users');
	
		// If we have to flush or forget cache from other resource
		// Just call the specific resource caching directly here.
		// For example : Caching::place()->change($placeId);
		
		//You can also flush tag here
		// For example : Cache::tags('users')->flush();
		
	}
}