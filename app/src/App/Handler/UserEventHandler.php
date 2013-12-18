<?php
namespace App\Handler;

use Creater;
use Updater;
use Destroyer;

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
		return Creater::user()->create($data);
	}

	/**
	 * On user update listener
	 */
	public function onUserUpdate($id, $data)
	{
		return Updater::user()->update($id, $data);
	}

	/**
	 * On user destroy listener
	 */
	public function onUserDestroy($id)
	{
		return Destroyer::user()->destroy($id);
	}
}