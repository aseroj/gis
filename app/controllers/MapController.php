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
      $filter = Input::get('filter');
      //$userWeight = 0;

      //ZAREH JAN, these are returning the selected weight in the box, do your magic...
      $weightAir        = Input::get('wa');
      $weightEarthquake = Input::get('we');
      $weightCrime      = Input::get('wc');


      $res = '';$out = '';

      if($filter){
        if(strpos($filter,',')){
          $tokenized = explode(',',$filter);
          $res = $tokenized[0]::all();
          $tokenized = array_combine(range(1, count($tokenized)), $tokenized);
          foreach($tokenized as $key){
            $res = $res->merge($key::all());
          }
        }else{
          $res = $filter::all();
        }
      }


      $cnt = count($res);
      $i=0;
      foreach($res as $result)
      {
        // if($air && $air=='earthquake')
        // {
        //   $weight = $result->mag;
        // }
        // else if($air=='air')
        // {
        //   $weight = $result->aqi_median/5;
        // }
      /*  else if($air && $air=='crime')
        {
          $res = USCrime::all();
          $weight = $result->total_crime/10;
        }*/
        $weight = 1;
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
