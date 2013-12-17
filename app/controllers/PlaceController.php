<?php
use App\Transformer\PlaceTransformer;

class PlaceController extends BaseController
{
	protected function boot()
	{
		$this->finder = Finder::place();
		$this->transformer = new PlaceTransformer();
	}
}