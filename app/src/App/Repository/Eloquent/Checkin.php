<?php
namespace App\Repository\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Repository\CheckinInterface;

class Checkin extends Model implements CheckinInterface
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
		return $this->belongsTo('App\Repository\Eloquent\User');
	}

	/**
	 * Relationship: Place
	 *
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function place()
	{
		return $this->belongsTo('App\Repository\Eloquent\Place');
	}
}