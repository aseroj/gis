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
     //$air = USCrime::All()
     //$this->layout->content = View::make('dbmunip')->with('usair', $air);

    /* $air = USEarthquakeCountyCrunched::all();
     $crunched = 0;
     $instances = 0;
     $total_mag = 0;
     $eq = USEarthquake::all();
     $this->layout->content = View::make('dbmunip')->with('usair', $air);
     foreach($eq as $val1)
     {
       $crunched->county = $val1->county;

       foreach($eq as $val2)
       {
         if($val2->county == $val1->county)
         {
           $total_mag += $val2->mag
           $instances++;
         }
       }
       $crunched->instances = $instances;
       $crunched->average_mag = $total_mag/$instances;
       //PUSH INTO TABLE
     }
     //$result = Geocoder::latlng($val->county,$val->state);
     //DBController::debug_to_console($result);
     //$val->lat = $result[0];
     //$val->lng = $result[1];
     //$val->save();

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
