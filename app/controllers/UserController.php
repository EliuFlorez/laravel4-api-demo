<?php
use App\Transformer\UserTransformer;
use App\Validator\Exceptions\ValidatorException;

class UserController extends BaseController
{

	protected function boot()
	{
		$this->finder = Finder::user();
		$this->transformer = new UserTransformer();
	}

	public function store()
	{
		try {
			$events = Event::fire('user.create', array(
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
			$events = Event::fire('user.update', array(
				$id,
				Input::all()
			));
			
			return Response::api()->withItem($events[0], $this->transformer);
		
		} catch (ValidatorException $e) {
			return Response::api()->errorWrongArgsValidator($e->getValidator());
		}
	}
}