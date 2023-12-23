<div class="map-container" id="contact-map-{{ $data->id }}"></div>

<script>
    function initialize_{{ $data->id }}() {
        var map_location_{{ $data->id }} = document.getElementById('contact-map-{{ $data->id }}');

        var mapOptions_{{ $data->id }} = {
            zoom: 12
        };

        var map_{{ $data->id }} = new google.maps.Map(map_location_{{ $data->id }}, mapOptions_{{ $data->id }});

        var pos_{{ $data->id }} = new google.maps.LatLng({{ $data->latitude }}, {{ $data->longitude }});

        var infowindow_{{ $data->id }} = new google.maps.InfoWindow({
            content: '{{ $data->value }}'
        });

        var marker_{{ $data->id }} = new google.maps.Marker({
            position: pos_{{ $data->id }},
            map: map_{{ $data->id }},
            title: '{{ $data->value }}',
            draggable: true
        });

        map_{{ $data->id }}.setCenter(pos_{{ $data->id }});

        google.maps.event.addListener(marker_{{ $data->id }}, 'click', function() {
            infowindow_{{ $data->id }}.open(map_{{ $data->id }}, marker_{{ $data->id }});
        });

        google.maps.event.addListener(marker_{{ $data->id }}, 'dragend', function(evt){
            _tnr_xhr.saveContactOptionMap({{ $data->id }}, evt.latLng.lat().toFixed(12), evt.latLng.lng().toFixed(12), '{{ route('admin.update-contact-option-map') }}');
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        google.maps.event.addDomListener(window, 'load', initialize_{{ $data->id }});
    });
</script>
