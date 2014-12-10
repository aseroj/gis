<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Tool for Living Conditions (WIP)</title>
	<style>
		@import url(//fonts.googleapis.com/css?family=Lato:700);
		body { margin:0; font-family:'Lato', sans-serif; text-align:center; color: #999; }
		.welcome { width: 400px; height: 200px; position: absolute; left: 50%; top: 50%; margin-left: -150px; margin-top: -100px; }
		.welcome-top { width: 550px; height: 200px; position: absolute; left: 45%; top: 15%; margin-left: -150px; margin-top: -100px; }
		a, a:visited { text-decoration:none; }
		h1 { font-size: 32px; margin: 16px 0 0 0; }
		img { -webkit-transition: all 0.5s ease 0s; -moz-transition: all 0.5s ease 0s; -o-transition: all 0.5s ease 0s; -ms-transition: all 0.5s ease 0s; transition: all 0.5s ease 0s; cursor:pointer; }
		img:hover { -webkit-transform: rotate(360deg); -moz-transform: rotate(360deg); -ms-transform: rotate(360deg); -o-transform: rotate(360deg); transform: rotate(360deg); }
	</style>
</head>
<body>
	<div class="welcome-top">
		<p>Click on the ”Filter” button to select filters and weights, further information can be found by mousing over the question mark symbol next to each filter. Weights will change how data is shown. For example, selecting a 4 on the “Earthquake” weight will cause earthquakes with magnitude below and equal to 4 to be colored green and all above to be a gradient from yellow to red.
			Data represented is based on the USGS(Earthquake), FBI(Crime) and EPA(Air Quality). They are represented based on county.<br />
			To limit search to a region, hit the “Select Search Bounds” button.</p>
	</div>
	<div class="welcome">
		<a href="/heat_map" title="Live">
			<img src="/img/globe.png" alt="Live">
		</a>
		<h1>Where do you want to live ?</h1>
	</div>
</body>
</html>
