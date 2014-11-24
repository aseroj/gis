@extends('layouts.main')
@section('content')

<script>

var revgeocoder = new google.maps.Geocoder();
var infowindow = new google.maps.InfoWindow();

function crunchDB()
{

}

function getRegion()
{
  var latlng = new google.maps.LatLng(-33.4560656,-70.655883);
  revgeocoder.geocode({'latLng': latlng}, function(results, status)
  {
    if (status == google.maps.GeocoderStatus.OK)
      {
        infowindow.setContent(results[1].formatted_address);
        alert(results[1].formatted_address);
      }
      else
      {
        alert("Geocoder failed due to: " + status);
      }
  });
    
    @foreach($usair as $air)
    {
      alert($air->lat);
    }
    @endforeach
}

</script>

<button onclick="getRegion()">Get Region</button>

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
