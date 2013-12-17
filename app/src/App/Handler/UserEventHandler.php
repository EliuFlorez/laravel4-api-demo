<?php
namespace App\Handler;

use Creater;


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
	}

	/**
	 * On user create listener
	 */
	public function onUserCreate($data)
	{
		return Creater::user()->create($data);
	}
}