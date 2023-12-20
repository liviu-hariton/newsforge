{!! $composer_package_warning !!}

<div class="form-group row">
    <label for="mailgun_domain" class="col-sm-2 col-form-label">Domain</label>
    <div class="col-sm-4">
        <input type="text" id="mailgun_domain" name="mailgun_domain" value="{{ old('mailgun_domain', $_tnrs->mailgun_domain ?? '') }}" class="form-control">

        @error('mailgun_domain')
        <div class="text-danger">{!! $message !!}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="mailgun_secret" class="col-sm-2 col-form-label">Secret</label>
    <div class="col-sm-4">
        <input type="text" id="mailgun_secret" name="mailgun_secret" value="{{ old('mailgun_secret', $_tnrs->mailgun_secret ?? '') }}" class="form-control">

        @error('mailgun_secret')
        <div class="text-danger">{!! $message !!}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="mailgun_endpoint" class="col-sm-2 col-form-label">Endpoint</label>
    <div class="col-sm-4">
        <input type="text" id="mailgun_endpoint" name="mailgun_endpoint" value="{{ old('mailgun_endpoint', $_tnrs->mailgun_endpoint ?? '') }}" class="form-control">

        @error('mailgun_endpoint')
        <div class="text-danger">{!! $message !!}</div>
        @enderror
    </div>
</div>
