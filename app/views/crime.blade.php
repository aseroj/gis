@extends('layouts.main')

@section('content')
<div class="col col-sm-9">
  <div class="table-responsive">
    <table class="table table-stripped table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Crime Type</th>
          <th>Created at</th>
          <th>Updated at</th>
        </tr>
      </thead>
      <tbody>
        @foreach($uscrime as $crime)
        <tr>
          <td>{{ $crime->id }}</td>
          <td>{{ $crime->crime_type }}</td>
          <td>{{ $crime->created_at }}</td>
          <td>{{ $crime->updated_at }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@stop
