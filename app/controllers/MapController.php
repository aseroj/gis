<?php

class MapController extends BaseController {
  protected $layout = "layouts.full";

  public function getIndex() {
//    $air = USEarthquake::all()->take(10)->toArray();
    $air = USEarthquake::all()->take(10);
    $this->layout->content = View::make('heatmap')->with('usair', $air);
  }

  public function postGo(){
      $air = Input::get('filter');
      $res = '';$out = '';
      if($air && $air=='earthquake'){
          $res = USEarthquake::all()->take(20);
      }

      $out = '[';
      foreach($res as $result){
          $out .= 'new google.maps.LatLng('.$result->lat.','.$result->lng.' ),';
      }
      $out .= ']';
      $response = array('status'=>'success','out'=>$out);

      return Response::json($response);
  }

}
