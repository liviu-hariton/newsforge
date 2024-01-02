<div class="card mb-4 p-0 contact-fields-sort-container">
    <div class="card-header px-3 pt-3 header-elements-inline">
        <h5 class="card-title text-primary">Contact form fields</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a href="#new-form-field" data-toggle="modal" class="list-icons-item text-dark" data-popup="tooltip" title="Add new form field"><i class="bi bi-plus-circle"></i></a>
            </div>
        </div>
    </div>

    <div class="card-body px-3">
        <table class="table table-hover table-striped">
            <tbody
                class="contact-fields-sortable"
                id="contact-fields-sortable"
                data-container="contact-fields-sort-container"
                data-model="App^Models^ContactForm"
                data-route="{{ route('admin.update-sort-order') }}"
            >
            @foreach($form_fields  as $form_field)
                @include('backend.settings.blocks.contact.contact-form-field', ['data' => $form_field])
            @endforeach
            </tbody>

            @if($form_fields->count() === 0)
                <div class="note note-info">
                    There are no form fields added yet. <a href="#new-form-field" class="btn btn-sm btn-info" data-toggle="modal">Add new form field</a>
                </div>
            @endif
        </table>
    </div>
</div>

<div id="new-form-field" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" action="{{ route('admin.settings.add.contact.field') }}" name="f-new-contact-field" id="f-new-contact-field" class="form-horizontal tnr-ays">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Add a new field to the contact form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-9">
                                <label for="name">Name: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">

                                <span class="form-text text-muted {{ old('name_as_placeholder') === '' ? 'd-none' : '' }}" id="field-regular-label">will be displayed next to the field</span>
                                <span class="form-text text-muted {{ old('name_as_placeholder') === '' ? '' : 'd-none' }}" id="field-placeholder">will be displayed inside the field</span>

                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label>&nbsp;</label>
                                <div class="custom-control custom-switch custom-switch-square custom-control-info mt-2">
                                    <input
                                        type="checkbox"
                                        class="custom-control-input tnr-toggle-alternate"
                                        data-alternate-1="field-regular-label"
                                        data-alternate-2="field-placeholder"
                                        name="name_as_placeholder"
                                        id="name_as_placeholder"
                                        value="1"
                                        {{ old('name_as_placeholder') === '1' ? 'checked' : '' }}
                                    >
                                    <label class="custom-control-label" for="name_as_placeholder">as placeholder</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea rows="2" class="form-control" name="description" id="description">{{ old('description') }}</textarea>
                        <span class="form-text text-muted">will be displayed next to the field</span>

                        @error('description')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="columns"><i class="fa-solid fa-table-columns"></i> Columns:</label>
                                <select class="custom-select" name="columns" id="columns">
                                    @foreach(consecutiveNumbers(1, 12) as $number)
                                    <option value="{{ $number }}" {{ old('columns') === $number ? 'selected' : '' }}>{{ $number }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label for="field-type">&nbsp;</label>
                                <select data-placeholder="Choose the field type" class="form-control select-icons" name="contact_field_type_id" id="field-type" style="width:100%;" onchange="Tnr.setFieldMaxLength(this.value)">
                                    <option value=""></option>
                                    @foreach($form_field_types as $field_type)
                                    <option value="{{ $field_type->id }}" data-icon="{{ $field_type->icon }}" {{ (int) old('contact_field_type_id') === $field_type->id ? 'selected="selected"' : '' }}>{{ $field_type->name }}</option>
                                    @endforeach
                                </select>

                                @error('contact_field_type_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <div id="max-length-container" class="{{ in_array((int) old('contact_field_type_id'), ['1', '5', '8', '11', '12']) ? '' : 'd-none' }}">
                                    <label for="max_length">Character limit (max):</label>
                                    <input type="text" class="form-control" name="max_length" id="max_length" value="{{ old('max_length') }}">

                                    @error('max_length')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="custom-control custom-switch custom-switch-square custom-control-info mt-2">
                                    <input type="checkbox" class="custom-control-input" name="required" id="required" value="1" {{ old('required') !== null && (int) old('required') === 1 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="required">required field</label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div id="extensions-container" class="{{ (int) old('contact_field_type_id') === 10 ? '' : 'd-none'}}">
                                    <input type="text" class="form-control" name="extensions" id="extensions" value="{{ old('extensions') }}">
                                    <span class="form-text text-muted">Supported extensions, comma separated. Example: pdf, txt</span>

                                    @error('extensions')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-switch custom-switch-square custom-control-info mt-2">
                            <input type="checkbox" class="custom-control-input" name="active" id="field-active" value="1" {{ old('active') !== null && (int) old('active') === 1 ? 'checked' : '' }}>
                            <label class="custom-control-label" for="field-active">active</label>
                        </div>
                    </div>

                    <hr/>

                    <div class="form-group">
                        <label for="notes">Internal notes:</label>
                        <textarea rows="2" class="form-control" name="notes" id="notes">{{ old('notes') }}</textarea>
                        <span class="form-text text-muted">they will not be displayed in the contact form</span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>

                    <button type="submit" id="save_form_data" class="btn btn-success btn-labeled btn-labeled-right">
                        <b><i class="fas fa-check"></i></b> Add field
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@if( session()->has('open-new-form-field-modal') )
    <script>
        $(document).ready(function() {
            $('#new-form-field').modal('show');
        });
    </script>
@endif
