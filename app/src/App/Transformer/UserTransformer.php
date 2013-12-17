<?php

namespace App\Transformer;

use App\Repository\UserInterface;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{

	protected $availableEmbeds = [
		'checkins'
	];

	/**
	 * Turn this item object into a generic array
	 *
	 * @return array
	 */
	public function transform(UserInterface $user)
	{
		return [
			'id' => (int) $user->id,
			'name' => $user->name,
			'bio' => $user->bio,
			'gender' => $user->gender,
			'location' => $user->location,
			'birthday' => $user->birthday,
			'joined' => (string) $user->created_at
		];
	}

	public function links(UserInterface $user, $url, $method)
	{
		return [
			'settings' => $this->addLink("{$url}/{$this->id}/settings", 'GET')
		];
	}

	/**
	 * Embed Checkins
	 *
	 * @return League\Fractal\Resource\Collection
	 */
	public function embedCheckins(UserInterface $user)
	{
		$checkins = $user->checkins;
		
		return $this->collection($checkins, new CheckinTransformer());
	}
}
