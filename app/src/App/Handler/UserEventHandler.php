<?php
namespace App\Handler;

use Creater;
use Updater;


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
}