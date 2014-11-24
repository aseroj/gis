@extends('layouts.main')

@section('content')
<script>

function opacityNum(num, m){
  var val = 0.7*linearcdf(m,num);
  return val;
}

function opacitySum(positions,at){
  var valf = 0;
  for(var i=0; i<positions.length; i++){
    var x = getDistance(positions[i],at);
    valf = valf + opacityNum(x,mean);
  }
  return valf;
}

function linearcdf(mean,x){
  x=Math.abs(x);
  return Math.max((2*mean-x)/(2*mean),0);
}

var rad = function(x) {
  return x * Math.PI / 180;
};

var getDistance = function(p1, p2) {
  var R = 6378137; // Earth�s mean radius in meter
  var dLat = rad(p2.lat() - p1.lat());
  var dLong = rad(p2.lng() - p1.lng());
  var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
  Math.cos(rad(p1.lat())) * Math.cos(rad(p2.lat())) *
  Math.sin(dLong / 2) * Math.sin(dLong / 2);
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
  var d = R * c;
  return d; // returns the distance in meter
};

var map;
var mean = 1000;
function initialize() {
  var mapOptions = {
    zoom: 14,
    center: new google.maps.LatLng(-33.4560656,-70.655883,14)
  };
  map = new google.maps.Map(document.getElementById('map-canvas'),
  mapOptions);
  positions = [map.getCenter(), new google.maps.LatLng(-33.465, -70.63),
  new google.maps.LatLng(-33.435,-70.63)];
  setTimeout("drawHeatPoints(positions)",1000);
}

google.maps.event.addDomListener(window, 'load', initialize);

function drawHeatPoints(positions){

  var bounds = map.getBounds();
  var res = 100;
  var startx = bounds.getNorthEast().lng();
  var stepx= (bounds.getSouthWest().lng() - startx)/res;
  var starty = bounds.getNorthEast().lat();
  var stepy= (bounds.getSouthWest().lat() - starty)/res;
  for(var i=0;i<res;i++){
    for(var j=0;j<res;j++){
      var square = [
      new google.maps.LatLng(starty + stepy*i, startx+j*stepx),
      new google.maps.LatLng(starty + stepy*i, startx+j*stepx +stepx),
      new google.maps.LatLng(starty + stepy*(1+i), startx+j*stepx + stepx),
      new google.maps.LatLng(starty + stepy*(i+1), startx+j*stepx ),
      new google.maps.LatLng(starty + stepy*i, startx+j*stepx)
      ];
      var squarePol = new google.maps.Polygon({
        paths: square,
        strokeOpacity: 0,
        strokeWeight: 3,
        fillColor: "#FF0000",
        fillOpacity: opacitySum(positions,new google.maps.LatLng(starty + stepy*i, startx+j*stepx))
      });
      squarePol.setMap(map);

    }
  }


}

</script>

<div class="col col-sm-9">
  <div class="row">
      <?php var_dump($usair); ?>



      <div id="map-canvas"></div>
  </div>
</div>
@stop
