<?php
namespace App\Transformer;

use App\Repository\PlaceInterface;
use League\Fractal\TransformerAbstract;

class PlaceTransformer extends TransformerAbstract
{

	protected $availableEmbeds = [
		'checkins'
	];

	/**
	 * Turn this item object into a generic array
	 *
	 * @return array
	 */
	public function transform(PlaceInterface $place)
	{
		return [
			'id' => (int) $place->id,
			'name' => $place->name,
			'lat' => (float) $place->lat,
			'lon' => (float) $place->lon,
			'address1' => $place->address1,
			'address2' => $place->address2,
			'city' => $place->city,
			'state' => $place->state,
			'zip' => (float) $place->zip,
			'website' => $place->website,
			'phone' => $place->phone
		];
	}

	/**
	 * Embed Checkins
	 *
	 * @return League\Fractal\Resource\Collection
	 */
	public function embedCheckins(PlaceInterface $place)
	{
		$checkins = $place->checkins;
		
		return $this->collectionResource($checkins, new CheckinTransformer());
	}
}
