<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Heatmaps</title>
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
      #panel {
        position: absolute;
        top: 5px;
        left: 50%;
        margin-left: -180px;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
      }
    </style>
    {{ HTML::script('//maps.googleapis.com/maps/api/js?v=3.exp&libraries=visualization') }}
    {{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js') }}
    </head>
    <body>
        @yield('content')
    </body>
</html>