<?php

class MapController extends BaseController {
  protected $layout = "layouts.full";

  public function getIndex() {
    $air = USEarthquake::all()->take(10);
    $this->layout->content = View::make('heatmap')->with('usair', $air);
  }

  public function postGo()
  {
    /*
    To user bounds
    $north_east = whatever
    $south_west = whatever

    if($result->lat <= $north_east[0] && $result->lat >= $south_west[0])
    {
      if($result->lng <= $north_east[1] && $result->lat >= $south_west[1])
      {
        push
      }
    }
    */
      $array = array();
      $weight = 0;
      $air = Input::get('filter');
      //$userWeight = 0;
      $res = '';$out = '';

      if($air && $air=='earthquake')
      {
          $res = USEarthquake::all();
          $userWeight = (int)Input::get('weight_air');
      }
      else if($air && $air=='air')
      {
        $res = USAir::all();
        $userWeight = Input::get('weight_earthquake');
      }
      /*else if($air && $air=='crime')
      {
        $res = USCrime::all();
        $userWeight = Input::get('weight_crime');
      }*/
      else
      {
        //MERGE DB's
        $res = USAir::all();
      }

      $cnt = count($res);
      $i=0;
      foreach($res as $result)
      {
        if($air && $air=='earthquake')
        {
          $weight = $result->mag;
        }
        else if($air=='air')
        {
          $weight = $result->aqi_median/5;
        }
      /*  else if($air && $air=='crime')
        {
          $res = USCrime::all();
          $weight = $result->total_crime/10;
        }*/
        array_push($array, $result->lat, $result->lng, $weight);
      }
      $response = array('status'=>'success','out'=>$array);

      return Response::json($response);
      /*
      First 2 members of array should be worst air and worst eartquake counties.
      Worst earthquake can come from us_earthquake_county_Crunched
      $w_air = array();
      $w_eq = array();
      array_push($w_air, 0, "", 0, "", 0, "",);
      array_push($w_eq, 0, "", 0, "", 0, "");


      foreach($res as $result)
      {
        if($res->weight > $w_eq[0])
        {
          $w_eq[0] = $res->weight;
          $w_eq[1] = $res->county;
        }

        else if($res->weight > $w_eq[2])
        {
          $w_eq[2] = $res->weight;
          $w_eq[3] = $res->county;
        }
        else if($res->weight > $w_eq[4])
        {
          $w_eq[4] = $res->weight;
          $w_eq[5] = $res->county;
        }
      }

      */


  }

}
