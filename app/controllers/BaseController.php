<?php

class BaseController extends Controller
{

	/**
	 * The repository name of the resource
	 *
	 * @var mixed
	 */
	protected $finder;

	/**
	 * The resource transformer
	 *
	 * @var string
	 */
	protected $transformer;

	/**
	 * Base controller constructor
	 */
	public function __construct()
	{
		$this->boot();
	}

	/**
	 * Boot the controller
	 */
	protected function boot()
	{
		//
	}

	public function index()
	{
		$collection = $this->finder->findForIndex();
		
		return Response::api()->withCollection($collection, $this->transformer);
	}

	public function show($id)
	{
		$item = $this->finder->find($id);
		
		return Response::api()->withItem($item, $this->transformer);
	}
}