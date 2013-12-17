<?php
use App\Transformer\UserTransformer;

class UserController extends BaseController
{
	protected function boot()
	{
		$this->finder = Finder::user();
		$this->transformer = new UserTransformer();
	}
}