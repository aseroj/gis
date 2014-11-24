<?php

class AirController extends BaseController {
  protected $layout = "layouts.main";

  public function getIndex() {
    $air = USAir::all();
    $this->layout->content = View::make('air')->with('usair', $air);

    $eq = USEarthquake::all();
  }

}
