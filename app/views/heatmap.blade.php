@extends('layouts.full')

@section('content')

{{ HTML::script('/js/go.js') }}

<script>
// Adding Data Points
var map, pointarray, heatmap, regionBox, regionBounds;

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
    zoom: 4,
    center: new google.maps.LatLng(37.0625,-95.677068),
  //  mapTypeId: google.maps.MapTypeId.SATELLITE
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

/*
Draggable LatLng box for uzer to specify search region, activates on button click
function displayRegionBox()
{
  regionBounds = new google.maps.LatLngBounds(
  new google.maps.LatLng(37.0625,-95.677068),
  new google.maps.LatLng(37.1625,-95.647068)
  );

// Define a rectangle and set its editable property to true.
regionBox = new google.maps.Rectangle({
bounds: regionBounds,
editable: true
});

regionBox.setMap(map);
}

To use bounds call
regionBox.getBounds().getNorthEast();
regionBox.getBounds().getSouthWest();

*/

function reinitialize()
{
  var data;
  var array = [];
  heatmap.setMap(null);
  var i = 0;
  /*
  First 2 members of glboalMap are arrays
  var worst_air = [];
  var worst_eq = [];

  worst_eq.push(globalMap[1]);
  worst_eq.push(globalMap[3]);
  worst_eq.push(globalMap[5]);

  Display in top right corner
  */
  //Weighted point, weight = 3 means 3 heatmap poitns on top of each other
  console.log(globalMap.length/3)
  for(i=0;i<globalMap.length;i+=3)
    {
    console.log(globalMap[i], globalMap[i+1], globalMap[i+2])
    array.push({location: new google.maps.LatLng(globalMap[i], globalMap[i+1]),
       weight: globalMap[i+2]});
  }

  heatmap = new google.maps.visualization.HeatmapLayer({
    data: array

  });

  heatmap.setMap(map);
  heatmap.setOptions ({
    dissipating: true,
    maxIntensity: 100,
    radius: 30,
    opacity: 0.9,
    //dissipating: false
  })
}

function displayWorstCounties()
{

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
                    <div class="checkbox">
                      <label><input type="checkbox" class="chk" name="filter" value="crime">Crime</label>
                    </div>
                    <div class="">
                      <label>Weight</label>
                      <select class="form-control" name="weight_crime">
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
