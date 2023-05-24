<!-- Google API -->
<!-- AIzaSyC5yreJhIC-v-FDNOf1RFZ1C46y7bgAwLw -->

<!DOCTYPE html>
<html>
<head>
	<title>Map with Google API</title>
	<style>
		#map {
			height: 500px;
			width: %;
		}
	</style>
</head>
<body>
	<h1>Map with Google API</h1>
	<div id="map"></div>
	<script>
		function initMap() {
			// Get user location
			navigator.geolocation.getCurrentPosition(function(position) {
				var userLocation = {
					lat: position.coords.latitude,
					lng: position.coords.longitude
				};

				// Create map centered on user location
				var map = new google.maps.Map(document.getElementById('map'), {
					zoom: 15,
					center: userLocation
				});

				// Create marker for user location
				var userMarker = new google.maps.Marker({
					position: userLocation,
					map: map,
					title: 'Your Location'
				});

				// Create marker for goal location
				var goalLocation = {lat: -8.7989375, lng: 115.2319375};
				var goalMarker = new google.maps.Marker({
					position: goalLocation,
					map: map,
					title: 'Goal Location'
				});

				// Create circle around goal location
				var goalCircle = new google.maps.Circle({
					strokeColor: '#0000FF',
					strokeOpacity: 0.8,
					strokeWeight: 2,
					fillColor: '#0000FF',
					fillOpacity:0.35,
					map: map,
					center: goalLocation,
					radius: 100 // in meters
				});

				// Check if user is within circle
				google.maps.event.addListener(map, 'idle', function() {
					var distance = google.maps.geometry.spherical.computeDistanceBetween(userMarker.getPosition(), goalCircle.getCenter());
					if (distance <= goalCircle.getRadius()) {
						alert('You Have Arrived');
					}
				});

				// Create directions service and display route from user location to goal location
				var directionsService = new google.maps.DirectionsService();
				var directionsDisplay = new google.maps.DirectionsRenderer();
				directionsDisplay.setMap(map);
				var request = {
					origin: userLocation,
					destination: goalLocation,
					travelMode: 'DRIVING'
				};
				directionsService.route(request, function(result, status) {
					if (status == 'OK') {
						directionsDisplay.setDirections(result);
					}
				});
			});
		}
	</script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5yreJhIC-v-FDNOf1RFZ1C46y7bgAwLw&callback=initMap"></script>
</body>
</html>

<!-- Google API -->
<!-- AIzaSyC5yreJhIC-v-FDNOf1RFZ1C46y7bgAwLw -->