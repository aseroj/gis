@extends('layouts.main')
@section('content')
</script>


<div class="col col-sm-9">
  <div class="table-responsive">
    <table class="table table-stripped table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>County</th>
          <th>State</th>
          <th>AQI</th>
          <th>Lat</th>
          <th>Lng</th>
        </tr>
      </thead>
      <tbody>
        @foreach($usair as $air)
        <tr>
          <td>{{ $air->id }}</td>
          <td>{{ $air->county }}</td>
          <td>{{ $air->state }}</td>
          <td>{{ $air->aqi_median }}</td>
          <td>{{ $air->lat}}</td>
          <td>{{ $air->lng }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@stop
