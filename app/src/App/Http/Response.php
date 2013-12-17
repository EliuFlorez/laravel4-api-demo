<?php
namespace App\Http;

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

/**
 *
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
class Response
{

	protected $statusCode = 200;

	/**
	 * Getter for statusCode
	 *
	 * @return mixed
	 */
	public function getStatusCode()
	{
		return $this->statusCode;
	}

	/**
	 * Setter for statusCode
	 *
	 * @param int $statusCode
	 *        	Value to set
	 *        	
	 * @return self
	 */
	public function setStatusCode($statusCode)
	{
		$this->statusCode = $statusCode;
		return $this;
	}

	protected function respondWithItem($item, $callback)
	{
		$resource = new Item($item, $callback);
		
		$rootScope = $this->fractal->createData($resource);
		
		return $this->respondWithArray($rootScope->toArray());
	}

	protected function respondWithCollection($collection, $callback)
	{
		$resource = new Collection($collection, $callback);
		
		$rootScope = $this->fractal->createData($resource);
		
		return $this->respondWithArray($rootScope->toArray());
	}

	protected function respondWithArray(array $array, array $headers = array())
	{
		return Response::json($array, $this->statusCode, $headers);
	}
}