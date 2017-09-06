@extends('layouts/web/master_admin')
@section('pageTitle', 'Tracking Driver')
@section('content-subheader', 'Tracking Driver')
@section('main-content')
	<div id="map" style="height: 500px; width: 100%">
		{{config('app.googlemap') }}
	</div>
	@include('layouts.web.partials.footer')
@endsection

@section('script')
<script>
	function initMap() {

		// ----------------------------------------------- ROUTE REQUEST -----------------------------------------------

		var current_destination = //gps location titik awal
		{
			lat: {{ $current_lat }},
			lng: {{ $current_lng }},
		}

		var last_destination = //gps location titik tujuan
		{
			lat: {{ $last_lat }},
			lng: {{ $last_lng }},
		}
		var directions_display = new google.maps.DirectionsRenderer();
		var directions = new google.maps.DirectionsService();
		var directions_request = {
			origin: current_destination,
			destination: last_destination,
			travelMode: 'DRIVING',
			provideRouteAlternatives: true,
		}
		directions.route(directions_request, function(result, status) {
			if(status == 'OK') {
				directions_display.setDirections(result);
			}
		});

		// ------------------------------------------------------- INTITIAL MAP ----------------------------------------

		var myCenter = //lokasi center dari map
		{
			lat: {{ $current_lat}},
			lng: {{ $current_lng}},
		}

		var options = //options default setting map, zoom buat level map zoom nya, center buat lokasi center dr map nya
		{
			zoom: 7,
			center: myCenter,
		}

		var map = new google.maps.Map(document.getElementById('map'), options);
		directions_display.setMap(map);

		// -------------------------------------------------- MARKER -----------------------------------------------------

		// var current_marker = new google.maps.Marker({ //gps marker buat titik awal
		// 	position: current_destination,
		// 	map: map //tampilin di map yg mana -> ngerujuk ke variable map
		// });

		// var destination_marker = new google.maps.Marker({ //gps marker buat titik awal
		// 	position: last_destination,
		// 	map: map, //tampilin di map yg mana -> ngerujuk ke variable map
		// });

	}
</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key={{ config('app.googlemap') }}&callback=initMap">
    // these callback is to call function you provide for google map api
</script>
@endsection