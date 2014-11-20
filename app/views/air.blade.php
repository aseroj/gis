@extends('layouts.main')

@section('content')
<div class="col col-sm-9">
  <div class="table-responsive">
    <table class="table table-stripped table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>County</th>
          <th>State</th>
          <th>Days AQI</th>
          <th>Good</th>
          <th>Moderate</th>
          <th>Unhealthy</th>
        </tr>
      </thead>
      <tbody>
        @foreach($usair as $air)
          <tr>
            <td>{{ $air->id }}</td>
            <td>{{ $air->county }}</td>
            <td>{{ $air->state }}</td>
            <td>{{ $air->days_aqi }}</td>
            <td>{{ $air->good }}</td>
            <td>{{ $air->moderate }}</td>
            <td>{{ $air->unhealthy_sensitive }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@stop
