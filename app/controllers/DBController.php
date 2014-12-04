<?php

class DBController extends BaseController {
  protected $layout = "layouts.main";

  public function getIndex() {
    // $air = USEarthquake::all()->take(10);
    // $this->layout->content = View::make('dbmunip')->with('usair', $air);


    //todo: if doesn't have county, remain empty(NULL)

    $eq = USEarthquake::all();
    foreach($eq as $val) {
      $county = Geocoder::county($val->lat,$val->lng);
      $county = explode(',', $county);
      $county_clean = str_replace(' County', '', $county[0]);
      $val->county = (!empty($county_clean) ? $county_clean : NULL);
      $val->save();

      // echo '<br /><h1>'.$county_clean[0].'</h1>';
    }

  }
  public function getLatlng() {
    foreach(){
      Geocoder::latlng($county, $state);
    }
  }
}
