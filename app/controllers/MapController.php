<?php

class MapController extends BaseController {
  protected $layout = "layouts.main";

  public function getIndex() {
    $air = USEarthquake::all()->take(10)->toArray();
    $this->layout->content = View::make('map')->with('usair', json_encode($air));


    // lat lng depth

    // return Response::json($response);
  }

}
