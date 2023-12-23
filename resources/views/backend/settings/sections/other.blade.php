<form action="{{ route('admin.settings.general.store') }}" method="post" name="f-save-other" id="f-save-other">
    @csrf
    @method('PATCH')

    <input type="hidden" name="group" id="group-other" value="other" />

    <h4 class="mb-2 text-primary">Google Maps</h4>

    <div class="form-group row">
        <label for="google_maps_api_key" class="col-sm-2 col-form-label">API Key</label>
        <div class="col-sm-4">
            <input type="text" id="google_maps_api_key" name="google_maps_api_key" value="{{ old('google_maps_api_key', $_tnrs->google_maps_api_key ?? '') }}" class="form-control">

            @error('google_maps_api_key')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="latitude" class="col-sm-2 col-form-label">Default Latitude</label>
        <div class="col-sm-5">
            <input type="text" id="latitude" name="latitude" value="{{ old('latitude', $_tnrs->latitude ?? '') }}" class="form-control">

            @error('latitude')
            <div class="text-danger">{!! $message !!}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="longitude" class="col-sm-2 col-form-label">Default Longitude</label>
        <div class="col-sm-5">
            <input type="text" id="longitude" name="longitude" value="{{ old('longitude', $_tnrs->longitude ?? '') }}" class="form-control">

            @error('longitude')
            <div class="text-danger">{!! $message !!}</div>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn btn-primary btn-pill mr-2 mt-5">
        Save <i class="fas fa-chevron-right"></i>
    </button>

    <button type="submit" class="btn btn-danger btn-pill mr-2 mt-5 float-right" form="f-reset-other">
        Reset all <i class="fas fa-redo"></i>
    </button>
</form>

<form action="{{ route('admin.settings.general.reset') }}" method="post" name="f-reset-other" id="f-reset-other">
    @csrf
    @method('DELETE')

    <input type="hidden" name="group" id="group-reset" value="other" />
</form>
