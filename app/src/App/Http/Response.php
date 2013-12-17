<?php
namespace App\Http;

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Manager;
use Input;
use Response as IlluminateResponse;

/**
 *
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
class Response
{

	public function __construct(Manager $fractal)
	{
		$this->fractal = $fractal;
		
		// Are we going to try and include embedded data?
		$this->fractal->setRequestedScopes(explode(',', Input::get('include')));
	}

	/**
	 * Response status code
	 *
	 * @var int
	 */
	protected $statusCode = 200;

	/**
	 * Getter for statusCode
	 *
	 * @return int
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

	/**
	 * Response for one item
	 *
	 * @param mixed $item        	
	 * @param mixed $callback        	
	 * @return \Illuminate\Http\Response
	 */
	public function withItem($item, $callback)
	{
		$resource = new Item($item, $callback);
		
		$rootScope = $this->fractal->createData($resource);
		
		return $this->withArray($rootScope->toArray());
	}

	/**
	 * Response for collection of items
	 *
	 * @param mixed $item        	
	 * @param mixed $callback        	
	 * @return \Illuminate\Http\Response
	 */
	public function withCollection($collection, $callback)
	{
		$resource = new Collection($collection, $callback);
		
		$rootScope = $this->fractal->createData($resource);
		
		return $this->withArray($rootScope->toArray());
	}

	/**
	 * Response for array
	 *
	 * @param mixed $item        	
	 * @param mixed $callback        	
	 * @return \Illuminate\Http\Response
	 */
	public function withArray(array $array, array $headers = array())
	{
		return IlluminateResponse::json($array, $this->statusCode, $headers);
	}
}