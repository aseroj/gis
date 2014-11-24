<?php

class MapController extends BaseController {
  protected $layout = "layouts.full";

  public function getIndex() {
//    $air = USEarthquake::all()->take(10)->toArray();
    $air = USEarthquake::all()->take(10);
    $this->layout->content = View::make('heatmap')->with('usair', $air);


    // lat lng depth

    // return Response::json($response);
  }

}
