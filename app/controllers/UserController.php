<?php
use App\Transformer\UserTransformer;
use App\Repository\UserInterface;

class UserController extends Controller
{

	public function __construct(UserInterface $user)
	{
		$this->user = $user;
	}

	public function index()
	{
		$users = $this->user->take(10)->get();
		
		return Response::api()->withCollection($users, new UserTransformer());
	}

	public function show($id)
	{
		$user = $this->user->find($id);
		
		return Response::api()->respondWithItem($user, new UserTransformer());
	}
}