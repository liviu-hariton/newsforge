<div class="card mb-4 p-0 overall-contact-map-container">
    <div class="card-header px-3 pt-3 header-elements-inline">
        <h5 class="card-title text-primary">Contact map</h5>
    </div>

    <div class="card-body px-3">
        @if(isset($_tnrs->google_maps_api_key))
        <div class="form-group">
            <div class="custom-control custom-switch custom-switch-square custom-control-info">
                <input
                    type="checkbox"
                    class="custom-control-input tnr-target-toggler tnr-xhr"
                    data-call-method="change"
                    data-xhr="changeSettingsValue"
                    data-key="show_contact_map"
                    data-route="{{ route('admin.update-setting-value') }}"
                    data-group="contact"
                    data-container="overall-contact-map-container"
                    name="show_contact_map"
                    id="show_contact_map"
                    value="1"
                    data-tnr-toggle-target="overall-contact-map-container"
                    {{ isset($_tnrs->show_contact_map) ? 'checked' : '' }}
                >
                <label class="custom-control-label" for="show_contact_map">show contact map</label>
            </div>
        </div>

        <div id="overall-contact-map-container" class="{{ isset($_tnrs->show_contact_map) ? '' : 'd-none' }}">
            <div class="form-group">
                <label>Positioning on the map: <span class="overall_map_status"></span><br /><small>(drag the marker on the map, in the desired location)</small></label>
            </div>

            <div class="map-container-taller" id="overall-contact-map"></div>

            <script>
                var map;

                function initializeOverallNew() {
                    var map_location = document.getElementById('overall-contact-map');

                    var mapOptions = {
                        zoom: 12
                    };

                    var map = new google.maps.Map(map_location, mapOptions);

                    if(navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(position) {
                            @if(!isset($_tnrs->latitude) || !isset($_tnrs->longitude))
                            const pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                            @else
                            const pos = new google.maps.LatLng({{ $_tnrs->latitude }}, {{ $_tnrs->longitude }});
                            @endif

                            const infowindow = new google.maps.InfoWindow({
                                content: 'Position detected automatically'
                            });

                            const marker = new google.maps.Marker({
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
                                _tnr_xhr.saveContactMap(evt.latLng.lat().toFixed(12), evt.latLng.lng().toFixed(12), '{{ route('admin.update-contact-map') }}');
                            });
                        }, function() {
                            handleNoOverallGeolocation(true);
                        });
                    }
                    else {
                        handleNoOverallGeolocation(false);
                    }
                }

                function handleNoOverallGeolocation(errorFlag) {
                    if(errorFlag) {
                        const content = 'Error: Geolocation failed.<br />Move the marker to the desired position.';
                    } else {
                        const content = 'Error: Your browser does not support geolocation.';
                    }

                    const map_location = document.getElementById('overall-contact-map');

                    let mapOptions = {
                        zoom: 4
                    };

                    const map = new google.maps.Map(map_location, mapOptions);

                    const pos = new google.maps.LatLng({{ $_tnrs->latitude ?? 48.200022871201654 }}, {{ $_tnrs->longitude ?? 17.087633309325387 }});

                    let options = {
                        position: pos,
                        content: content
                    };

                    const infowindow = new google.maps.InfoWindow(options);

                    const marker = new google.maps.Marker({
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
                         _tnr_xhr.saveContactMap(evt.latLng.lat().toFixed(12), evt.latLng.lng().toFixed(12), '{{ route('admin.update-contact-map') }}');
                    });
                }

                document.addEventListener('DOMContentLoaded', function() {
                    google.maps.event.addDomListener(window, 'load', initializeOverallNew);
                });
            </script>
        </div>
        @else
        <div class="note note-warning">
            You need to set the Google Maps API key in order to use this feature. <a href="#" onclick="showTab('other')" class="btn btn-sm btn-warning">Set the API key</a>
        </div>
        @endif
    </div>
</div>
