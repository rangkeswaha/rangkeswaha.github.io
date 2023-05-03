<style>
    #map {
        height: 400px;
        width: 100%;
    }

</style>

<input type="text" id="address-input">
<button onclick="geocodeAddress()">Check Place</button>
<div id="map"></div>

<!-- Load the Google Maps JavaScript API asynchronously -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5yreJhIC-v-FDNOf1RFZ1C46y7bgAwLw&libraries=places&callback=initMap"></script>


<script>
    let map;
    let geocoder;
    let marker;

    function initMap() {
        // Create a new map centered on Indonesia
        map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: -0.7893, lng: 113.9213 },
            zoom: 6
        });

        // Create a new geocoder
        geocoder = new google.maps.Geocoder();

        // Create a new autocomplete object for the address input
        autocomplete = new google.maps.places.Autocomplete(
            document.getElementById('address-input'),
            { types: ['geocode'] }
        );

        // When the user selects an address from the autocomplete dropdown
        autocomplete.addListener('place_changed', () => {
            // Get the selected place from the autocomplete object
            const place = autocomplete.getPlace();

            // If the place has a geometry object, center the map on it and add a marker
            if (place.geometry) {
            map.setCenter(place.geometry.location);
            map.setZoom(16);

            // Remove any existing marker from the map
            if (marker) {
                marker.setMap(null);
            }

            // Create a new marker at the selected location
            marker = new google.maps.Marker({
                map: map,
                position: place.geometry.location,
                draggable: true
            });

            // When the user drags the marker, update the address input with the new location
            marker.addListener('dragend', () => {
                geocoder.geocode({ location: marker.getPosition() }, (results, status) => {
                if (status === 'OK') {
                    if (results[0]) {
                    document.getElementById('address-input').value = results[0].formatted_address;
                    }
                }
                });
            });
            }
        });
    }

    // Define the geocodeAddress function
    function geocodeAddress() {
        // Get the address input element
        const addressInput = document.getElementById('address-input');

        // Geocode the entered address
        geocoder.geocode({ address: addressInput.value }, (results, status) => {
            if (status === 'OK') {
            // Center the map on the geocoded location
            map.setCenter(results[0].geometry.location);
            map.setZoom(16);

            // Remove any existing marker from the map
            if (marker) {
                marker.setMap(null);
            }

            // Create a new marker at the geocoded location
            marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location,
                draggable: true
            });

            // When the user drags the marker, update the address input with the new location
            marker.addListener('dragend', () => {
                geocoder.geocode({ location: marker.getPosition() }, (results, status) => {
                    if (status === 'OK') {
                        if (results[0]) {
                        document.getElementById('address-input').value = results[0].formatted_address;
                        }
                    }
                });
            });

            // Get the latitude, longitude, and formatted address of the geocoded location
            const latitude = results[0].geometry.location.lat();
            const longitude = results[0].geometry.location.lng();
            const formattedAddress = results[0].formatted_address;

            // Display the latitude, longitude, and formatted address in an alert
            alert(`Latitude: ${latitude}\nLongitude: ${longitude}\nAddress: ${formattedAddress}`);
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }

</script>


<!-- Google API -->
<!-- AIzaSyC5yreJhIC-v-FDNOf1RFZ1C46y7bgAwLw -->