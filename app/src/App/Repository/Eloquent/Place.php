<?php
namespace App\Repository\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Repository\PlaceInterface;

class Place extends Model implements PlaceInterface
{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'places';

	/**
	 * Relationship: Checkins
	 *
	 * @return Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function checkins()
	{
		return $this->hasMany('App\Repository\Eloquent\Checkin');
	}
}