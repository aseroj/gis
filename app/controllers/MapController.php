<?php

class MapController extends BaseController {
  protected $layout = "layouts.full";

  public function getIndex() {
    $air = USEarthquake::all()->take(10);
    $this->layout->content = View::make('heatmap')->with('usair', $air);
  }

  public function postGo(){
      $array = array();

      $air = Input::get('filter');
      $res = '';$out = '';
      if($air && $air=='earthquake'){
          $res = USEarthquake::all();
      }

      $out = '[';
      $cnt = count($res);
      $i=0;
      foreach($res as $result){
        array_push($array, $result->lat, $result->lng);
      }
      $out .= ']';
      $response = array('status'=>'success','out'=>$array);

      return Response::json($response);
  }

}
