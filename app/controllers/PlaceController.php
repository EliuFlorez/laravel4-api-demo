<?php

class PlaceController extends BaseController
{

	protected $repository = 'App\Repository\PlaceInterface';

	protected static $transformer = 'App\Transformer\PlaceTransformer';
}