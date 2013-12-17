<?php

class IndexController extends Controller
{

	public function index()
	{
		return Response::api()->errorForbidden();
	}
}