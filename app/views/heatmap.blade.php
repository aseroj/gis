@extends('layouts.full')

@section('content')

{{ HTML::script('/js/go.js') }}

<script>
// Adding Data Points
var map, pointarray, heatmap;

var globalMap;

function mapData(latlng){
    if(latlng == null || latlng==''){
        var mapLatLng = [
            @foreach($usair as $air)
                {{ 'new google.maps.LatLng('.$air->lat.', '.$air->lng.' ),' }}
            @endforeach
        ];
    } else {
        var mapLatLng = latlng;
    }
//    console.log(mapLatLng);
    return mapLatLng;
}

function initialize() {
  var mapOptions = {
    zoom: 3,
    center: new google.maps.LatLng(37.0625,-95.677068),
    mapTypeId: google.maps.MapTypeId.SATELLITE
  };

  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

  var pointArray = new google.maps.MVCArray(mapData(''));

  heatmap = new google.maps.visualization.HeatmapLayer({
    data: pointArray
  });

  // heatmap.set('radius', 50);
  // heatmap.setMap(map);
}

function reinitialize() {
  var data;
  var array = [];
  var i = 0;
  //Weighted point, weight = 3 means 3 heatmap poitns on top of each other
  array.push({location: new google.maps.LatLng(globalMap[0], globalMap[1]),
    weight: globalMap[2]/2});
  for(i=3;i<globalMap.length/2;i++)
    {
      array.push(new google.maps.LatLng(globalMap[i], globalMap[i+1]));
        i++;
  }

  heatmap = new google.maps.visualization.HeatmapLayer({
    data: array
  });
  heatmap.set('radius', 20);
  heatmap.setMap(map);
}

function redraw(map){
    globalMap = map;
    reinitialize();
}

function toggleHeatmap() {
  heatmap.setMap(heatmap.getMap() ? null : map);
}

function changeGradient() {
  var gradient = [
    'rgba(0, 255, 255, 0)',
    'rgba(0, 255, 255, 1)',
    'rgba(0, 191, 255, 1)',
    'rgba(0, 127, 255, 1)',
    'rgba(0, 63, 255, 1)',
    'rgba(0, 0, 255, 1)',
    'rgba(0, 0, 223, 1)',
    'rgba(0, 0, 191, 1)',
    'rgba(0, 0, 159, 1)',
    'rgba(0, 0, 127, 1)',
    'rgba(63, 0, 91, 1)',
    'rgba(127, 0, 63, 1)',
    'rgba(191, 0, 31, 1)',
    'rgba(255, 0, 0, 1)'
  ]
  heatmap.set('gradient', heatmap.get('gradient') ? null : gradient);
}

function changeRadius() {
  heatmap.set('radius', heatmap.get('radius') ? null : 100);
}

function changeOpacity() {
  heatmap.set('opacity', heatmap.get('opacity') ? null : 0.2);
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>


    <div id="panel">
      <button onclick="toggleHeatmap()">Toggle Heatmap</button>
      <button onclick="changeGradient()">Change gradient</button>
      <!-- <button onclick="changeRadius()">Change radius</button> -->
      <button onclick="changeOpacity()">Change opacity</button>
      <button data-toggle="modal" data-target="#myModal">Filter</button>
    </div>
    <div id="map-canvas"></div>



    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog price-star-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Filtering Options</h4>
                </div>
                <h3 class="star-desc"></h3>
                <div class="modal-body">
                    <div class="checkbox">
                      <label><input type="checkbox" class="chk" name="filter" value="air">Air Quality</label>
                    </div>
                    <label>Weight</label>
                    <select class="form-control" name="weight_air">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                    <div class="checkbox">
                      <label><input type="checkbox" class="chk" name="filter" value="earthquake">Earthquake</label>
                    </div>
                    <div class="">
                        <label>Weight</label>
                        <select class="form-control" name="weight_earthquake">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" id="btn-go" class="btn btn-success btn-md"><span>Go</span></a>
                </div>
            </div>
        </div>
    </div>

@stop
