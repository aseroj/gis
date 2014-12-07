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
          <th>Instances</th>
          <th>Average_mag</th>
        </tr>
      </thead>
      <tbody>
        @foreach($usair as $air)
        <tr>
          <td>{{ $air->id }}</td>
          <td>{{ $air->county }}</td>
          <td>{{ $air->instances }}</td>
          <td>{{ $air->average_mag}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@stop
