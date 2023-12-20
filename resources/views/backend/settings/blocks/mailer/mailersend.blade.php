{!! $composer_package_warning !!}

<div class="form-group row">
    <label for="mailersend_api_key" class="col-sm-2 col-form-label">API Token</label>
    <div class="col-sm-4">
        <input type="text" id="mailersend_api_key" name="mailersend_api_key" value="{{ old('mailersend_api_key', $_tnrs->mailersend_api_key ?? '') }}" class="form-control">

        @error('mailersend_api_key')
        <div class="text-danger">{!! $message !!}</div>
        @enderror
    </div>
</div>
