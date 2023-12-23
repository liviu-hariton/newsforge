<div class="map-container" id="contact-map"></div>

<script>
    var map;

    function initializeNew() {
        var map_location = document.getElementById('contact-map');

        var mapOptions = {
            zoom: 12
        };

        var map = new google.maps.Map(map_location, mapOptions);

        if(navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                @if(old('contact_option_type_id') !== '10')
                const pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                @else
                const pos = new google.maps.LatLng({{ old('latitude') }}, {{ old('longitude') }});
                @endif

                var infowindow = new google.maps.InfoWindow({
                    content: 'Position detected automatically'
                });

                var marker = new google.maps.Marker({
                    position: pos,
                    map: map,
                    title: 'Position detected automatically',
                    draggable: true
                });

                map.setCenter(pos);

                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open(map, marker);
                });

                google.maps.event.addListener(marker, 'dragend', function(evt){
                    $('#latitude-new-method').val(evt.latLng.lat().toFixed(12));
                    $('#longitude-new-method').val(evt.latLng.lng().toFixed(12));
                });
            }, function() {
                handleNoGeolocation(true);
            });
        }
        else {
            handleNoGeolocation(false);
        }
    }

    function handleNoGeolocation(errorFlag) {
        if(errorFlag) {
            var content = 'Error: Geolocation failed.<br />Move the marker to the desired position.';
        } else {
            var content = 'Error: Your browser does not support geolocation.';
        }

        var map_location = document.getElementById('contact-map');

        var mapOptions = {
            zoom: 4
        };

        var map = new google.maps.Map(map_location, mapOptions);

        var pos = new google.maps.LatLng({{ old('latitude', $_tnrs->latitude ?? '') }}, {{ old('longitude', $_tnrs->longitude ?? '') }});

        var options = {
            position: pos,
            content: content
        };

        var infowindow = new google.maps.InfoWindow(options);

        var marker = new google.maps.Marker({
            position: pos,
            map: map,
            draggable: true,
            title: 'Move the marker to the desired position'
        });

        map.setCenter(options.position);

        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map, marker);
        });

        google.maps.event.addListener(marker, 'dragend', function(evt){
            $('#latitude-new-method').val(evt.latLng.lat().toFixed(12));
            $('#longitude-new-method').val(evt.latLng.lng().toFixed(12));
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        google.maps.event.addDomListener(window, 'load', initializeNew);
    });
</script>
