<?php
namespace App\Handler;

use Creater;
use Updater;
use Destroyer;
use Caching;

class UserEventHandler
{

	/**
	 * Subscribe to events
	 *
	 * @param Event $events        	
	 */
	public function subscribe($events)
	{
		$events->listen('user.create', 'App\Handler\UserEventHandler@onUserCreate');
		$events->listen('user.update', 'App\Handler\UserEventHandler@onUserUpdate');
		$events->listen('user.destroy', 'App\Handler\UserEventHandler@onUserDestroy');
	}

	/**
	 * On user create listener
	 */
	public function onUserCreate($data)
	{
		//Create the user
		$user = Creater::user()->create($data);
		
		//The user have changed so, notify the caching service
		Caching::user()->change($user->id);
		
		//Return the user
		return $user;
	}

	/**
	 * On user update listener
	 */
	public function onUserUpdate($id, $data)
	{
		
		//Update the user
		$user =  Updater::user()->update($id, $data);
		
		//The user have changed so, notify the caching service
		Caching::user()->change($user->id);
		
		//Return the user
		return $user;
	}

	/**
	 * On user destroy listener
	 */
	public function onUserDestroy($id)
	{
		//Destroy the user
		$user =  Destroyer::user()->destroy($id);
		
		//The user have changed so, notify the caching service
		Caching::user()->change($user->id);
		
		//Return the user
		return $user;
	}
}