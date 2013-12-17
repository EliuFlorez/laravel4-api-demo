<?php

class BaseController extends Controller
{

	/**
	 * The repository name of the resource
	 *
	 * @var mixed
	 */
	protected $repository;

	/**
	 * The resource transformer
	 *
	 * @var string
	 */
	protected static $transformer;

	/**
	 * Base controller constructor
	 */
	public function __construct()
	{
		// If the repository is defined
		if ($this->repository) {
			$this->repository = App::make($this->repository);
		}
	}

	public function index()
	{
		$collection = $this->repository->take(10)->get();
		
		return Response::api()->withCollection($collection, App::make(static::$transformer));
	}

	public function show($id)
	{
		$item = $this->repository->find($id);
		
		return Response::api()->withItem($item, App::make(static::$transformer));
	}
}