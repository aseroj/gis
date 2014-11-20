<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width" />
  <meta name="viewport" content="initial-scale=1.0">
  <meta charset="utf-8">
  {{ HTML::style('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css') }}
  {{ HTML::style('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css') }}
  {{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js') }}
  {{ HTML::script('//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js') }}

  <script type="text/javascript">
  var base = '';
  function url(relate) { return base + relate; }
  </script>
  <title>GIS MAP</title>
</head>
<body>
  <div class="navbar">
    <div class="navbar-inner">
      <div class="container">
        <ul class="nav navbar-nav pull-left">
          <li><a href="{{ url('air') }}">Air</a></li>
          <li><a href="{{ url('earthquake') }}">Earthquake</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="col-md-9">
      <div class="row">
        @yield('content')
      </div>
    </div>
  </div>
</body>
</html>
