<form action="{{ route('admin.settings.general.store') }}" method="post" name="f-save-fiscal" id="f-save-fiscal">
    @csrf
    @method('PATCH')

    <input type="hidden" name="group" id="group-other" value="fiscal" />

    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="company_fiscal">Organization Name: <span class="text-danger">*</span></label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="company" id="company_fiscal" value="{{ old('company', $_tnrs->company ?? '') }}">

            @error('company')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="country_fiscal" class="col-sm-2 col-form-label">Country: <span class="text-danger">*</span></label>
        <div class="col-sm-4">
            <select id="country_fiscal" name="country" class="form-control select2list" data-placeholder="Choose your country" style="width:100%;">
                <option value=""></option>
                @foreach(config('tnr.countries') as $country_code => $country_data)
                    <option value="{{ $country_code }}" {{ old('country', $_tnrs->country ?? '') === $country_code ? 'selected="selected"' : '' }}>{{ $country_data['country'] }}</option>
                @endforeach
            </select>

            @error('country')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">&nbsp;</label>
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-6">
                    <label for="region_fiscal">Region / Province: <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="region" id="region_fiscal" value="{{ old('region', $_tnrs->region ?? '') }}">

                    @error('region')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <label for="locality_fiscal">City / Locality: <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="locality" id="locality_fiscal" value="{{ old('locality', $_tnrs->locality ?? '') }}">

                    @error('locality')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="address_line_1_fiscal">Address line 1: <span class="text-danger">*</span></label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="address_line_1" id="address_line_1_fiscal" value="{{ old('address_line_1', $_tnrs->address_line_1 ?? '') }}">
            <span class="form-text text-muted">street name, street number</span>

            @error('address_line_1')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="address_line_2_fiscal">Address line 2:</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="address_line_2" id="address_line_2_fiscal" value="{{ old('address_line_2', $_tnrs->address_line_2 ?? '') }}">
            <span class="form-text text-muted">building, entrance, floor, apartment number etc.</span>

            @error('address_line_2')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="postal_code_fiscal">Postal code:</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" name="postal_code" id="postal_code_fiscal" value="{{ old('postal_code', $_tnrs->postal_code ?? '') }}">

            @error('postal_code')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="vat_id_fiscal">VAT ID:</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" name="vat_id" id="vat_id_fiscal" value="{{ old('vat_id', $_tnrs->vat_id ?? '') }}">

            @error('vat_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="other_fiscal">Other details:</label>
        <div class="col-sm-4">
            <textarea rows="5" class="form-control" name="other" id="other_fiscal">{{ old('other', $_tnrs->other ?? '') }}</textarea>
            <span class="form-text text-muted">one extra detail per line</span>

            @error('other')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn btn-primary btn-pill mr-2 mt-5">
        Save <i class="fas fa-chevron-right"></i>
    </button>

    <button type="submit" class="btn btn-danger btn-pill mr-2 mt-5 float-right" form="f-reset-fiscal">
        Reset all <i class="fas fa-redo"></i>
    </button>
</form>

<form action="{{ route('admin.settings.general.reset') }}" method="post" name="f-reset-fiscal" id="f-reset-fiscal">
    @csrf
    @method('DELETE')

    <input type="hidden" name="group" id="group-reset" value="fiscal" />
</form>
