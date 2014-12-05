<?php

class MapController extends BaseController {
  protected $layout = "layouts.full";

  public function getIndex() {
    $air = USEarthquake::all()->take(10);
    $this->layout->content = View::make('heatmap')->with('usair', $air);
  }

  public function postGo(){
      $array = array();
      $weight = 0;
      $air = Input::get('filter');
      $res = '';$out = '';
      if($air && $air=='earthquake')
      {
          $res = USEarthquake::all();
      }
      else if($air && $air=='air')
      {
        $res = USAir::all();
      }

      $out = '[';
      $cnt = count($res);
      $i=0;
      foreach($res as $result)
      {
        if($air && $air=='earthquake')
        {
          $weight = $result->mag;
        }
        else if($air && $air=='air')
        {
          $weight = $result->aqi_median;
        }
        array_push($array, $result->lat, $result->lng, $weight);
      }
      $out .= ']';
      $response = array('status'=>'success','out'=>$array);

      return Response::json($response);
  }

}
