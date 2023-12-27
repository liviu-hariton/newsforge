<div class="card p-0 tnr-sort-container">
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
            <tbody
                class="tnr-sortable"
                id="tnr-sortable"
                data-container="tnr-sort-container"
                data-model="App^Models^ContactOption"
                data-route="{{ route('admin.update-sort-order') }}"
            >
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

                            @if(isset($_tnrs->google_maps_api_key))
                                @include('backend.settings.blocks.contact.contact-data-option-map-new')
                            @else
                                <div class="note note-warning">
                                    You need to set the Google Maps API key in order to use this feature. <a href="#" data-dismiss="modal" onclick="showTab('other')" class="btn btn-sm btn-warning">Set the API key</a>
                                </div>
                            @endif
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
                            <p class="mb-2">(drag the marker on the map, in the desired location)</p>

                            @if(isset($_tnrs->google_maps_api_key))
                                @include('backend.settings.blocks.contact.contact-data-option-map-edit', ['data' => $data])
                            @else
                                <div class="note note-warning">
                                    You need to set the Google Maps API key in order to use this feature. <a href="#" data-dismiss="modal" onclick="showTab('other')" class="btn btn-sm btn-warning">Set the API key</a>
                                </div>
                            @endif
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
