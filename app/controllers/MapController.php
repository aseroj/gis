<?php

class MapController extends BaseController {
  protected $layout = "layouts.full";

  public function getIndex() {
    $air = USEarthquake::all()->take(10);
    $this->layout->content = View::make('heatmap')->with('usair', $air);
  }
  private static function calcWorstEq($currValue)
  {
    $result = false;
    if($currValue->mag > MapController::$w_eq[0])
    {
      MapController::$w_eq[0] = $currValue->mag;
      MapController::$w_eq[1] = $currValue->county;
    }

    else if($currValue->mag > MapController::$w_eq[2])
    {
      MapController::$w_eq[2] = $currValue->mag;
      MapController::$w_eq[3] = $currValue->county;
    }
    else if($currValue->mag > MapController::$w_eq[4])
    {
      MapController::$w_eq[4] = $currValue->mag;
      MapController::$w_eq[5] = $currValue->county;
    }

  }

  private static function calcWorstAir($currValue)
  {
    $result = false;
    if($currValue->aqi_median > MapController::$w_air[0])
    {
      MapController::$w_air[0] = $currValue->aqi_median;
      MapController::$w_air[1] = $currValue->county;
    }

    else if($currValue->aqi_median > MapController::$w_air[2])
    {
      MapController::$w_air[2] = $currValue->aqi_median;
      MapController::$w_air[3] = $currValue->county;
    }
    else if($currValue->aqi_median > MapController::$w_air[4])
    {
      MapController::$w_air[4] = $currValue->aqi_median;
      MapController::$w_air[5] = $currValue->county;
    }

  }

  public static function calcWeight($realWeight, $userWeight, $type)
  {
    $result = 1;

    if($type == 'earthquake')
    {
      $realScaled = ($realWeight - 4)*10;
      if($realScaled <= $userWeight)
        $result = $realScaled;
      else
        $result = 2^($realScaled*$userWeight);
    }
    else if($type == 'air')
    {
      $realScaled = $realWeight/6;
      if($realScaled <= $userWeight)
        $result = $realScaled;
      else
        $result = 2^($realScaled*$userWeight);

    }
    else if($type == 'crime')
    {
      $realScaled = $realWeight/100;
      if($realScaled <= $userWeight)
        $result = $realScaled;
      else
        $result = 2^($realScaled*$userWeight);

    }
    return $result;
  }

  public static function resetWorstArrays()
  {
    unset(MapController::$w_air[0]);
    unset(MapController::$w_air[1]);
    unset(MapController::$w_air[3]);

    unset(MapController::$w_eq[0]);
    unset(MapController::$w_eq[1]);
    unset(MapController::$w_eq[2]);

    array_push(MapController::$w_air, 0, "");
    array_push(MapController::$w_air, 0, "");
    array_push(MapController::$w_air, 0, "");

    array_push(MapController::$w_eq, 0, "");
    array_push(MapController::$w_eq, 0, "");
    array_push(MapController::$w_eq, 0, "");
  }

  public function postGo()
  {
    MapController::resetWorstArrays();
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
      $weightAir        = (int) Input::get('wa');
      $weightEarthquake = (int) Input::get('we');
      $weightCrime      = (int) Input::get('wc');


      $res = '';$out = '';

      if($filter)
      {
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
        $cnt = count($res);
        $i=0;
        foreach($res as $result)
        {
          if($result->mag)
          {
            $weight = MapController::calcWeight($result->mag, $weightEarthquake, 'earthquake');
            MapController::calcWorstEq($result);
          }
          else if($result->aqi_median)
          {
            $weight = MapController::calcWeight($result->aqi_median, $weightAir, 'air');
            MapController::calcWorstAir($result);
          }
          else if($result->total_crime)
          {
            $weight = MapController::calcWeight($result->total_crime, $weightCrime, 'crime');
        }
        //$weight = 1;
        array_push($array, $result->lat, $result->lng, $weight);
      }

      array_push($array,MapController::$w_air);
      array_push($array,MapController::$w_eq);
      $response = array('status'=>'success','out'=>$array);

    }
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

  private static $w_air = array();
  private static $w_eq = array();


}
