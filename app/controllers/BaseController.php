<?php


use App\Validator\Exceptions\ValidatorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
	 * The even namespace of the resource
	 * 
	 * @var string
	 */
	protected static $eventNamespace;

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

	public function store()
	{
		try {
			$events = Event::fire(static::$eventNamespace . '.create', array(
				Input::all()
			));
			
			return Response::api()->withItem($events[0], $this->transformer);
		
		} catch (ValidatorException $e) {
			return Response::api()->errorWrongArgsValidator($e->getValidator());
		}
	}

	public function update($id)
	{
		try {
			$events = Event::fire(static::$eventNamespace . '.update', array(
				$id,
				Input::all()
			));
			
			return Response::api()->withItem($events[0], $this->transformer);
		
		} catch (ModelNotFoundException $e) {
			return Response::api()->errorNotFound();
		} catch (ValidatorException $e) {
			return Response::api()->errorWrongArgsValidator($e->getValidator());
		}
	}

	public function destroy($id)
	{
		try {
			$events = Event::fire(static::$eventNamespace . '.destroy', array(
				$id
			));
			
			return Response::api()->withItem($events[0], $this->transformer);
		
		} catch (ModelNotFoundException $e) {
			return Response::api()->errorNotFound();
		}
	}
}