<?php
use App\Transformer\PlaceTransformer;
use App\Repository\PlaceInterface;

class PlaceController extends BaseController
{

	public function __construct(PlaceInterface $place)
	{
		$this->place = $place;
	}

	public function index()
	{
		$places = $this->place->take(10)->get();
		
		return Response::api()->withCollection($places, new PlaceTransformer());
	}

	public function show($id)
	{
		$place = $this->place->find($id);
		
		if(! $place){
			return Response::api()->errorNotFound();
		}
		
		return Response::api()->withItem($place, new PlaceTransformer());
	}
}