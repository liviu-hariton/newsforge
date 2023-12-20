{!! $composer_package_warning !!}

<div class="form-group row">
    <label for="ses_key" class="col-sm-2 col-form-label">Access Key</label>
    <div class="col-sm-4">
        <input type="text" id="ses_key" name="ses_key" value="{{ old('ses_key', $_tnrs->ses_key ?? '') }}" class="form-control">

        @error('ses_key')
        <div class="text-danger">{!! $message !!}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="ses_secret" class="col-sm-2 col-form-label">Secret Access Key</label>
    <div class="col-sm-4">
        <input type="text" id="ses_secret" name="ses_secret" value="{{ old('ses_secret', $_tnrs->ses_secret ?? '') }}" class="form-control">

        @error('ses_secret')
        <div class="text-danger">{!! $message !!}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="ses_region" class="col-sm-2 col-form-label">Default region</label>
    <div class="col-sm-4">
        <input type="text" id="ses_region" name="ses_region" value="{{ old('ses_region', $_tnrs->ses_region ?? '') }}" class="form-control">

        @error('ses_region')
        <div class="text-danger">{!! $message !!}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="ses_token" class="col-sm-2 col-form-label">Session Token</label>
    <div class="col-sm-4">
        <input type="text" id="ses_token" name="ses_token" value="{{ old('ses_token', $_tnrs->ses_token ?? '') }}" class="form-control">

        @error('ses_token')
        <div class="text-danger">{!! $message !!}</div>
        @enderror
    </div>
</div>
