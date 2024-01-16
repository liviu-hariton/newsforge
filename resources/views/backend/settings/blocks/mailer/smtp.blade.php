<div class="form-group row">
    <label for="smtp_host" class="col-sm-2 col-form-label">Host</label>
    <div class="col-sm-4">
        <input type="text" id="smtp_host" name="smtp_host" value="{{ old('smtp_host', $_tnrs->smtp_host ?? '') }}" class="form-control">

        @error('smtp_host')
        <div class="text-danger">{!! $message !!}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="smtp_port" class="col-sm-2 col-form-label">Port number</label>
    <div class="col-sm-3">
        <input type="text" inputmode="numeric" pattern="[0-9]*" id="smtp_port" name="smtp_port" value="{{ old('smtp_port', $_tnrs->smtp_port ?? '') }}" class="form-control">

        @error('smtp_port')
        <div class="text-danger">{!! $message !!}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="smtp_username" class="col-sm-2 col-form-label">Username</label>
    <div class="col-sm-4">
        <input type="email" id="smtp_username" name="smtp_username" value="{{ old('smtp_username', $_tnrs->smtp_username ?? '') }}" class="form-control">

        @error('smtp_username')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="smtp_password" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-4">
        <input type="password" id="smtp_password" name="smtp_password" value="{{ old('smtp_password', $_tnrs->smtp_password ?? '') }}" class="form-control">

        @error('smtp_password')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="smtp_encryption" class="col-sm-2 col-form-label">Encryption</label>
    <div class="col-sm-2">
        <select id="smtp_encryption" name="smtp_encryption" class="form-control">
            <option value="">-- none --</option>
            @foreach($encryption_methods as $encryption_method_id => $encryption_method_name)
                <option value="{{ $encryption_method_id }}" {!! old('smtp_encryption', $_tnrs->smtp_encryption ?? '') === $encryption_method_id ? 'selected="selected"' : '' !!}>{{ $encryption_method_name }}</option>
            @endforeach
        </select>
    </div>
</div>

<h6 class="mb-5 mt-2">Optional parameters</h6>

<div class="form-group row">
    <label for="smtp_url" class="col-sm-2 col-form-label">URL</label>
    <div class="col-sm-5">
        <input type="text" id="smtp_url" name="smtp_url" value="{{ old('smtp_url', $_tnrs->smtp_url ?? '') }}" class="form-control">

        @error('smtp_url')
        <div class="text-danger">{!! $message !!}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="smtp_local_domain" class="col-sm-2 col-form-label">Local domain (EHLO / HELO)</label>
    <div class="col-sm-4">
        <input type="text" id="smtp_local_domain" name="smtp_local_domain" value="{{ old('smtp_local_domain', $_tnrs->smtp_local_domain ?? '') }}" class="form-control">

        @error('smtp_local_domain')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
