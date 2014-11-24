<?php

class DBController extends BaseController {
  protected $layout = "layouts.main";

  public function getIndex() {
    $air = USEarthquake::all();
    $this->layout->content = View::make('dbmunip')->with('usair', $air);

    $eq = USEarthquake::all();
  }

}
