<form action="{{ route('admin.settings.general.store') }}" method="post" name="f-save-mailing" id="f-save-mailing">
    @csrf
    @method('PATCH')

    <input type="hidden" name="group" id="group-mailing" value="mailing" />

    <h4 class="mb-2 text-primary">Sender details</h4>

    <div class="form-group row">
        <label for="from_address" class="col-sm-2 col-form-label">Email address</label>
        <div class="col-sm-4">
            <input type="email" id="from_address" name="from_address" value="{{ old('from_address', $_tnrs->from_address ?? '') }}" class="form-control">

            @error('from_address')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="from_name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-4">
            <input type="text" id="from_name" name="from_name" value="{{ old('from_name', $_tnrs->from_name ?? '') }}" class="form-control">

            @error('from_name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <h4 class="mb-2 text-primary">Sending method</h4>

    <div class="form-group row">
        <label for="mailer_type" class="col-sm-2 col-form-label">Send emails with</label>
        <div class="col-sm-4">
            <select id="mailer_type" name="mailer_type" class="form-control tnr-xhr" data-call-method="change" data-xhr="loadMailerFormFields" data-route="{{ route('admin.load.mailer.form.fields') }}" data-target="mailer-form-fields-container">
                <option value="">-- Select --</option>
                @foreach($mailers as $mailer_key => $mailer_name)
                <option value="{{ $mailer_key }}" {!! old('mailer_type', $_tnrs->mailer_type) === $mailer_key ? 'selected="selected"' : '' !!}>{{ $mailer_name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div id="mailer-form-fields-container">{!! $selected_mailer !!}</div>

    <button type="submit" class="btn btn-primary btn-pill mr-2 mt-5">
        Save <i class="fas fa-chevron-right"></i>
    </button>

    <button type="submit" class="btn btn-danger btn-pill mr-2 mt-5 float-right" form="f-reset-mailing">
        Reset all <i class="fas fa-redo"></i>
    </button>
</form>

<form action="{{ route('admin.settings.general.reset') }}" method="post" name="f-reset-mailing" id="f-reset-mailing">
    @csrf
    @method('DELETE')

    <input type="hidden" name="group" id="group-reset" value="mailing" />
</form>
