<?php

class IndexController extends BaseController
{

	public function index()
	{
		return Response::api()->errorForbidden();
	}
}