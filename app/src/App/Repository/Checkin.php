<?php
namespace App\Repository;

use Illuminate\Database\Eloquent\Model;

class Checkin extends Eloquent
{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'checkins';

	/**
	 * Relationship: User
	 *
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo('App\Repository\User');
	}

	/**
	 * Relationship: Place
	 *
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function place()
	{
		return $this->belongsTo('App\Repository\Place');
	}
}