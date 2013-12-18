<?php

namespace App\Resource\Caching;

use App;
use Cache;

class User implements CachingInterface
{

	public function change($id = null)
	{
		Cache::forget('user.' . $id);
		Cache::forget('users');
	}
}