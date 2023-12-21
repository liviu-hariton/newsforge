<form action="{{ route('admin.settings.general.store') }}" method="post" name="f-save-social" id="f-save-social">
    @csrf
    @method('PATCH')

    <input type="hidden" name="group" id="group" value="social" />

    @foreach($social_networks as $social_network)
    <div class="form-group row">
        <label for="{{ $social_network['field'] }}" class="col-sm-2 col-form-label">{!! $social_network['label'] !!}</label>
        <div class="col-sm-7">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text {{ $social_network['icon'] }}"></span>
                </div>
                <input type="text" name="{{ $social_network['field'] }}" id="{{ $social_network['field'] }}" value="{{ old($social_network['field'], _tnrs($social_network['field']) ?? '') }}" class="form-control">

                @if(_tnrs($social_network['field']))
                <div class="input-group-append">
                    <a href="{{ _tnrs($social_network['field']) }}" target="_blank" class="btn btn-info" type="button"><i class="bi bi-box-arrow-up-right"></i></a>
                </div>
                @endif

            </div>

            @error($social_network['field'])
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    @endforeach

    <button type="submit" class="btn btn-primary btn-pill mr-2 mt-5">
        Save <i class="fas fa-chevron-right"></i>
    </button>

    <button type="submit" class="btn btn-danger btn-pill mr-2 mt-5 float-right" form="f-reset-social">
        Reset all <i class="fas fa-redo"></i>
    </button>
</form>

<form action="{{ route('admin.settings.general.reset') }}" method="post" name="f-reset-social" id="f-reset-social">
    @csrf
    @method('DELETE')

    <input type="hidden" name="group" id="group-reset" value="social" />
</form>
