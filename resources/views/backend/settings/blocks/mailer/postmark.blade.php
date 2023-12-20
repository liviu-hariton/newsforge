{!! $composer_package_warning !!}

<div class="form-group row">
    <label for="postmark_token" class="col-sm-2 col-form-label">Token</label>
    <div class="col-sm-4">
        <input type="text" id="postmark_token" name="postmark_token" value="{{ old('postmark_token', $_tnrs->postmark_token ?? '') }}" class="form-control">

        @error('postmark_token')
        <div class="text-danger">{!! $message !!}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="postmark_message_stream_id" class="col-sm-2 col-form-label">Message Stream ID</label>
    <div class="col-sm-4">
        <input type="text" id="postmark_message_stream_id" name="postmark_message_stream_id" value="{{ old('postmark_message_stream_id', $_tnrs->postmark_message_stream_id ?? '') }}" class="form-control">

        @error('postmark_message_stream_id')
        <div class="text-danger">{!! $message !!}</div>
        @enderror
    </div>
</div>
