<?php

class DBController extends BaseController
{
  protected $layout = "layouts.main";

  public static function debug_to_console( $data )
  {

    if ( is_array( $data ) )
    $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
    $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
  }

  public function getIndex()
   {
     $air = USAir::all();
     $this->layout->content = View::make('dbmunip')->with('usair', $air);
     foreach($air as $val)
     {
       $result = Geocoder::latlng($val->county,$val->state);
       //DBController::debug_to_console($result);
      $val->lat = $result[0];
      $val->lng = $result[1];
      $val->save();
     }
    /*$eq = USEarthquake::all();
    foreach($eq as $val) {
      $county = Geocoder::county($val->lat,$val->lng);
      $county = explode(',', $county);
      $county_clean = str_replace(' County', '', $county[0]);
      $val->county = (!empty($county_clean) ? $county_clean : NULL);
      $val->save();

      // echo '<br /><h1>'.$county_clean[0].'</h1>';
    }*/

  }

}
