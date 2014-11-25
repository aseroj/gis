<?php

class DBController extends BaseController {
  protected $layout = "layouts.main";

  public function getIndex() {
    // $air = USEarthquake::all()->take(10);
    // $this->layout->content = View::make('dbmunip')->with('usair', $air);

    $eq = USEarthquake::all()->take(6);
    foreach($eq as $val) {
      $county = Geocoder::county($val->lat,$val->lng);
      $county_clean = str_replace(' County', '', explode(',', $county));
      echo '<br /><h1>'.$county_clean[0].'</h1>';
    }

  }

}
