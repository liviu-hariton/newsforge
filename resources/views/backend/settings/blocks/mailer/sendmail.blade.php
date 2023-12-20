<div class="form-group row">
    <label for="sendmail_path" class="col-sm-2 col-form-label">Path</label>
    <div class="col-sm-4">
        <input type="text" id="sendmail_path" name="sendmail_path" value="{{ old('sendmail_path', $_tnrs->sendmail_path ?? '') }}" class="form-control">

        @error('sendmail_path')
        <div class="text-danger">{!! $message !!}</div>
        @enderror
    </div>
</div>
