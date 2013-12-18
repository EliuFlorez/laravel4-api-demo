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

	const CODE_WRONG_ARGS = 'GEN-WRONG-ARGS';

	const CODE_NOT_FOUND = 'GEN-NOT-FOUND';

	const CODE_INTERNAL_ERROR = 'GEN-INTERNAL-ERROR';

	const CODE_UNAUTHORIZED = 'GEN-UNAUTHORIZED';

	const CODE_FORBIDDEN = 'GEN-FORBIDDEN';

	const CODE_GONE = 'GEN-GONE';

	/**
	 * Response status code
	 *
	 * @var int
	 */
	protected $statusCode = 200;

	/**
	 * Fractal manager
	 *
	 * @var League\Fractal\Manager
	 */
	protected $fractal;

	/**
	 * Constructor
	 *
	 * @param League\Fractal\Manager $fractal        	
	 */
	public function __construct(Manager $fractal)
	{
		$this->fractal = $fractal;
		
		// Are we going to try and include embedded data?
		$this->fractal->setRequestedScopes(explode(',', Input::get('include')));
	}

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
	 * Value to set
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

	/**
	 * Generix reponse with error
	 *
	 * @param string $message        	
	 * @param string $errorCode        	
	 */
	protected function withError($message, $errorCode)
	{
		return $this->withArray([
			'error' => [
				'code' => $errorCode,
				'http_code' => $this->statusCode,
				'message' => $message
			]
		])
		
		;
	}

	/**
	 * Generates a Response with a 403 HTTP header and a given message.
	 *
	 * @param string $message        	
	 * @return Response
	 *
	 */
	public function errorForbidden($message = 'Forbidden')
	{
		return $this->setStatusCode(403)->withError($message, self::CODE_FORBIDDEN);
	}

	/**
	 * Generates a Response with a 500 HTTP header and a given message.
	 *
	 * @param string $message        	
	 * @return Response
	 *
	 */
	public function errorInternalError($message = 'Internal Error')
	{
		return $this->setStatusCode(500)->withError($message, self::CODE_INTERNAL_ERROR);
	}

	/**
	 * Generates a Response with a 404 HTTP header and a given message.
	 *
	 * @param string $message        	
	 * @return Response
	 *
	 */
	public function errorNotFound($message = 'Resource Not Found')
	{
		return $this->setStatusCode(404)->withError($message, self::CODE_NOT_FOUND);
	}

	/**
	 * Generates a Response with a 401 HTTP header and a given message.
	 *
	 * @param string $message        	
	 * @return Response
	 *
	 */
	public function errorUnauthorized($message = 'Unauthorized')
	{
		return $this->setStatusCode(401)->withError($message, self::CODE_UNAUTHORIZED);
	}

	/**
	 * Generates a Response with a 400 HTTP header and a given message.
	 *
	 * @param string $message        	
	 * @return Response
	 *
	 */
	public function errorWrongArgs($message = 'Wrong Arguments')
	{
		return $this->setStatusCode(400)->withError($message, self::CODE_WRONG_ARGS);
	}

	/**
	 * Generates a Response with a 410 HTTP header and a given message.
	 *
	 * @param string $message        	
	 * @return Response
	 *
	 */
	public function errorGone($message = 'Resource No Longer Available')
	{
		return $this->setStatusCode(410)->withError($message, self::CODE_GONE);
	}

	/**
	 * Generates a Response with a 400 HTTP header and a given message from validator
	 *
	 * @param Validator $validator        	
	 * @return Response
	 *
	 */
	public function errorWrongArgsValidator($validator)
	{
		return $this->errorWrongArgs(json_encode($validator->messages()
			->all()));
	}
}