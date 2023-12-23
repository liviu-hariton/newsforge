<div class="card p-0">
    <div class="card-header px-3 pt-3 header-elements-inline">
        <h5 class="card-title text-primary">Contacting methods</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a href="#new-contact-method" data-toggle="modal" class="list-icons-item text-dark" data-popup="tooltip" title="Add new method"><i class="bi bi-plus-circle"></i></a>
            </div>
        </div>
    </div>

    <div class="card-body px-3">
        <table class="table table-hover table-striped">
            <tbody class="contact-options-sortable" id="contact-options-sortable">
            @foreach($contact_options  as $contact_option)
                @include('backend.settings.blocks.contact.contact-data-option', ['data' => $contact_option])
            @endforeach
            </tbody>

            @if($contact_options->count() === 0)
            <div class="note note-info">
                There are no contact methods added yet. <a href="#new-contact-method" class="btn btn-sm btn-info" data-toggle="modal">Add new method</a>
            </div>
            @endif
        </table>
    </div>
</div>

<div id="new-contact-method" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('admin.settings.add.contact.method') }}" name="f-new-contact-method" id="f-new-contact-method">
                @csrf
                @method('PUT')

                <input type="hidden" name="latitude" id="latitude-new-method" value="{{ old('latitude', $_tnrs->latitude ?? '') }}" />
                <input type="hidden" name="longitude" id="longitude-new-method" value="{{ old('longitude', $_tnrs->longitude ?? '') }}" />

                <div class="modal-header">
                    <h5 class="modal-title">Add new contact method</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <select id="method-new-method" name="contact_option_type_id" class="form-control select-icons tnr-xhr" data-call-method="change" data-xhr="setMapPositioning" data-placeholder="Choose a contact method" style="width: 100%;">
                            <option value=""></option>
                            @foreach($contact_methods as $method)
                            <option value="{{ $method->id }}" data-icon="{{ $method->icon }}" {{ (int) old('contact_option_type_id') === $method->id ? 'selected="selected"' : '' }}>{{ $method->name }}</option>
                            @endforeach
                        </select>

                        @error('contact_option_type_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="value-new-method">Value:</label>
                        <input type="text" class="form-control" name="value" id="value-new-method" value="">

                        @error('value')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div id="contact-map-container" class="{{ old('contact_option_type_id') !== '10' ? 'd-none' : '' }}">
                        <div class="form-group">
                            <label>Positioning on the map: <br /><small>(drag the marker on the map, in the desired location)</small></label>

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
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="switch switch-primary form-control-label mr-2">
                            <input type="checkbox" class="switch-input form-check-input" name="active" id="active-new-method" value="1" {{ old('contact_option_type_id') === '10' ? (old('active') === '1' ? 'checked' : '') : 'checked' }}>
                            <span class="switch-label"><span class="switch-text">active</span></span>
                            <span class="switch-handle"></span>
                        </label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" id="save_form_data" class="btn btn-success btn-labeled btn-labeled-right">
                        <b><i class="fas fa-check"></i></b> Add method
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach($contact_options  as $data)
    @if($data->type->id === 10)
        <div id="map-edit-{{ $data->id }}" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <input type="hidden" name="latitude" id="latitude-{{ $data->id }}" value="{{ $data->latitude }}" />
                    <input type="hidden" name="longitude" id="longitude-{{ $data->id }}" value="{{ $data->longitude }}" />

                    <div class="modal-header">
                        <h5 class="modal-title">Change the position on the map <span class="map_option_{{ $data->id }}_status"></span></h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
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
                                        _tnr_xhr.saveContactOptionMap({{ $data->id }}, evt.latLng.lat().toFixed(12), evt.latLng.lng().toFixed(12));
                                    });
                                }

                                document.addEventListener('DOMContentLoaded', function() {
                                    google.maps.event.addDomListener(window, 'load', initialize_{{ $data->id }});
                                });
                            </script>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach

@if( session()->has('open-new-contact-method-modal') )
<script>
    $(document).ready(function() {
        $('#new-contact-method').modal('show');
    });
</script>
@endif
