<div class="card mb-4 p-0 contact-fields-sort-container">
    <div class="card-header px-3 pt-3 header-elements-inline">
        <h5 class="card-title text-primary">Contact form fields</h5>
        <div class="header-elements">
            <div class="list-icons">
                <div class="custom-control custom-switch custom-switch-square custom-control-info mr-2">
                    <input
                        type="checkbox"
                        class="custom-control-input tnr-xhr"
                        data-call-method="change"
                        data-xhr="changeSettingsValue"
                        data-key="show_contact_form"
                        data-route="{{ route('admin.update-setting-value') }}"
                        data-group="contact"
                        data-container="contact-fields-sort-container"
                        name="show_contact_form"
                        id="show_contact_form"
                        value="1"
                        {{ isset($_tnrs->show_contact_form) ? 'checked' : '' }}
                    >
                    <label class="custom-control-label" for="show_contact_form">show form</label>
                </div>
                |
                <a href="#new-form-field" data-toggle="modal" class="list-icons-item text-success" data-popup="tooltip" title="Add new form field"><i class="bi bi-plus-circle-fill"></i></a>
            </div>
        </div>
    </div>

    <div class="card-body px-3">
        <ul class="nav nav-tabs mb-3" id="contact-form-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="contact-form-fields-tab" data-toggle="pill" href="#contact-form-fields" role="tab"
                   aria-controls="contact-form-fields" aria-selected="true">Form fields</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-form-message-tab" data-toggle="pill" href="#contact-form-message" role="tab"
                   aria-controls="contact-form-message" aria-selected="false">Message structure</a>
            </li>
        </ul>
        <div class="tab-content mt-5" id="nav-tabContent">
            <div class="tab-pane fade show active" id="contact-form-fields" role="tabpanel" aria-labelledby="nav-contact-form-fields">
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

            <div class="tab-pane fade" id="contact-form-message" role="tabpanel" aria-labelledby="nav-contact-form-message">
                <form action="{{ route('admin.settings.general.store') }}" method="post" name="f-save-contact-form-message" id="f-save-contact-form-message">
                    @csrf
                    @method('PATCH')

                    <input type="hidden" name="group" id="group-contact" value="contact" />

                    <p>You can use the available fields bellow:</p>

                    <div class="contact-form-fields-container">
                        @foreach($form_fields  as $form_field)
                        @if($form_field->type->type !== 'file')
                        <span
                                class="badge badge-square {{ in_array($form_field->slug, $message_placeholders) ? 'badge-success' : 'badge-danger' }} tnr-insert-at-cursor clickable"
                                data-popup="tooltip"
                                title="{{ in_array($form_field->slug, $message_placeholders) ? 'Used' : 'Not used' }}"
                                id="field-as-tag-{{ $form_field->id }}"
                                data-content="[+{{ $form_field->slug }}+]"
                            >
                            {{ $form_field->name }}
                        </span>
                        @endif
                        @endforeach
                    </div>

                    <span class="form-text text-muted">(click on a field to insert it at cursor position)</span>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contact_from_name" class="col-form-label">From name: <span class="text-danger">*</span></label>
                                <input type="text" id="contact_from_name" name="contact_from_name" placeholder="[+name_field+]" value="{{ old('contact_from_name', $_tnrs->contact_from_name ?? '') }}" class="form-control">

                                @error('contact_from_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contact_from_email" class="col-form-label">From email: <span class="text-danger">*</span></label>
                                <input type="text" id="contact_from_email" name="contact_from_email" placeholder="[+email_field+]" value="{{ old('contact_from_email', $_tnrs->contact_from_email ?? '') }}" class="form-control">

                                @error('contact_from_email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="contact_subject" class="col-form-label">Subject: <span class="text-danger">*</span></label>
                        <input type="text" id="contact_subject" name="contact_subject" placeholder="New contact: &quot;[+subject_field+]&quot;" value="{{ old('contact_subject', $_tnrs->contact_subject ?? '') }}" class="form-control">

                        @error('contact_subject')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="contact_headers" class="col-form-label">Additional optional Headers:</label>
                        <textarea id="contact_headers" name="contact_headers" rows="3" placeholder="Reply-To: [+email_field+]&#10;Cc:&#10;Bcc:" class="form-control">{{ old('contact_headers', $_tnrs->contact_headers ?? '') }}</textarea>
                        <span class="form-text text-muted">one per line</span>

                        @error('contact_headers')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="contact_message" class="col-form-label">Message body: <span class="text-danger">*</span></label>
                        <textarea id="contact_message" name="contact_message" rows="10" placeholder="[+message_field+]" class="form-control">{{ old('contact_message', $_tnrs->contact_message ?? '') }}</textarea>

                        @error('contact_message')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="custom-control custom-switch custom-switch-square custom-control-info mr-2">
                        <input
                            type="checkbox"
                            class="custom-control-input tnr-xhr"
                            data-call-method="change"
                            data-xhr="changeSettingsValue"
                            data-key="send_contact_copy"
                            data-route="{{ route('admin.update-setting-value') }}"
                            data-group="contact"
                            data-container="contact-fields-sort-container"
                            name="send_contact_copy"
                            id="send_contact_copy"
                            value="1"
                            {{ isset($_tnrs->send_contact_copy) ? 'checked' : '' }}
                        >
                        <label class="custom-control-label" for="send_contact_copy">send a copy to the sender</label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-pill mr-2 mt-5">
                        Save <i class="fas fa-chevron-right"></i>
                    </button>

                    <button type="submit" class="btn btn-danger btn-pill mr-2 mt-5 float-right" form="f-reset-contact-form-message">
                        Reset all <i class="fas fa-redo"></i>
                    </button>
                </form>

                <form action="{{ route('admin.settings.general.reset') }}" method="post" name="f-contact-form-message" id="f-reset-contact-form-message">
                    @csrf
                    @method('DELETE')

                    <input type="hidden" name="group" id="group-reset" value="contact" />
                </form>
            </div>
        </div>
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
                            <div class="col-md-3">
                                <label for="field-type">&nbsp;</label>
                                <select data-placeholder="Choose field type" class="form-control select-icons" name="contact_field_type_id" id="field-type" style="width:100%;" onchange="Tnr.setFieldMaxLength(this.value)">
                                    <option value=""></option>
                                    @foreach($form_field_types as $field_type)
                                    <option value="{{ $field_type->id }}" data-icon="{{ $field_type->icon }}" {{ (int) old('contact_field_type_id') === $field_type->id ? 'selected="selected"' : '' }}>{{ $field_type->name }}</option>
                                    @endforeach
                                </select>

                                @error('contact_field_type_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <div id="min-length-container" class="{{ in_array((int) old('contact_field_type_id'), ['1', '5', '8', '11', '12']) ? '' : 'd-none' }}">
                                    <label for="min_length">Character limit (min):</label>
                                    <input type="text" class="form-control" name="min_length" id="min_length" value="{{ old('min_length') ?? '1' }}">

                                    @error('min_length')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div id="max-length-container" class="{{ in_array((int) old('contact_field_type_id'), ['1', '5', '8', '11', '12']) ? '' : 'd-none' }}">
                                    <label for="max_length">Character limit (max):</label>
                                    <input type="text" class="form-control" name="max_length" id="max_length" value="{{ old('max_length') ?? '100' }}">

                                    @error('max_length')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="custom-control custom-switch custom-switch-square custom-control-info mt-2">
                                        <input type="checkbox" class="custom-control-input" name="required" id="required" value="1" {{ old('required') !== null && (int) old('required') === 1 ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="required">required field</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch custom-switch-square custom-control-info mt-2">
                                        <input type="checkbox" class="custom-control-input" name="active" id="field-active" value="1" {{ old('active') !== null && (int) old('active') === 1 ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="field-active">active</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div id="extensions-container" class="{{ (int) old('contact_field_type_id') === 10 ? '' : 'd-none'}}">
                                    <input type="text" class="form-control" name="extensions" id="extensions" value="{{ old('extensions') }}">
                                    <span class="form-text text-muted">Supported <a href="https://www.iana.org/assignments/media-types/media-types.xhtml" target="_blank" data-popup="tooltip" title="See all available options">Mime types <i class="fas fa-external-link-alt"></i></a>, comma separated. Example: image/*,audio/*<br />Enter * for everything</span>

                                    @error('extensions')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div id="input-options-container" class="{{ in_array((int) old('contact_field_type_id'), ['13', '14', '15']) ? '' : 'd-none' }}">
                                    <div class="form-group">
                                        <label for="input-options">Options:</label>
                                        <textarea rows="3" class="form-control" name="input_options" id="input-options" placeholder="value,label&#10;value,label&#10;value,label&#10;">{{ old('input_options') }}</textarea>
                                        <span class="form-text text-muted">One set per line. Set example: <em class="text-danger">value,label</em></span>
                                    </div>

                                    @error('input_options')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
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
