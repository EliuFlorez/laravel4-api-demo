<?php

class UserController extends BaseController
{

	protected $repository = 'App\Repository\UserInterface';

	protected static $transformer = 'App\Transformer\UserTransformer';
}