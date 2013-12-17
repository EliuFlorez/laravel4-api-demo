<?php

use App\Transformer\PlaceTransformer;
use App\Repository\Place;

class PlaceController extends Controller
{
    public function index()
    {
        $places = Place::take(10)->get();

        return Response::api()->withCollection($places, new PlaceTransformer);
    }

    public function show($id)
    {
        $place = Place::find($id);

        return Response::api()->withItem($place, new PlaceTransformer);
    }
}