@extends('layouts.main')
@section('content')

<script type="text/javascript">

var revgeocoder = new google.maps.Geocoder();
var infowindow = new google.maps.InfoWindow();

function crunchDB()
{

}

function getRegion({{$usair}})
{
  @foreach($usair as $air)
  <?php sleep(2) ?>
  var latlng = new google.maps.LatLng({{$air->lat}},{{$air->lng}});
  revgeocoder.geocode({'latLng': latlng}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
        infowindow.setContent(results[1].formatted_address);
        console.log(results[1].formatted_address);
      } else {
        alert("Geocoder failed due to: " + status);
      }
  });
  @endforeach
}

</script>

<button onclick="getRegion();">Get Region</button>

<div class="col col-sm-9">
  <div class="table-responsive">
    <table class="table table-stripped table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Latitude</th>
          <th>Longitude</th>
          <th>Time</th>
          <th>Magnitude </th>
          <th>Region</th>
        </tr>
      </thead>
      <tbody>
        @foreach($usair as $air)
        <tr>
          <td>{{ $air->id }}</td>
          <td>{{ $air->lat }}</td>
          <td>{{ $air->lng }}</td>
          <td>{{ $air->time }}</td>
          <td>{{ $air->mag }}</td>
          <td>{{ $air->region }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@stop
