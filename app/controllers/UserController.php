<?php
use App\Transformer\UserTransformer;
use App\Repository\User;

class UserController extends Controller
{

	public function index()
	{
		$users = User::take(10)->get();
		
		return Response::api()->withCollection($users, new UserTransformer());
	}

	public function show($id)
	{
		$user = User::find($id);
		
		return Response::api()->respondWithItem($user, new UserTransformer());
	}
}