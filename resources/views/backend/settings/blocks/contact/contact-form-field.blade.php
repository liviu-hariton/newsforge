<tr class="tnr-show-inline-edits" data-entry-id="{{ $data->id }}" id="field-row-{{ $data->id }}">
    <td>
        <i class="bi bi-arrow-down-up text-primary cursor-move tnr-sort-handle"></i>
    </td>
    <td class="text-center"><i class="{{ $data->type->icon }} fs-{{ $data->id }}6" data-popup="tooltip" title="{{ $data->type->name }}"></i></td>
    <td>
        <strong
            class="text-primary"
            id="field-name-{{ $data->id }}"
            data-toggle="manual"
            data-name="name" {{-- this is the table column name that will be updated with the new value --}}
            data-pk="{{ $data->id }}" {{-- table row ID --}}
            data-check-exists="false"
            data-title="Field name"
            data-model="App^Models^ContactForm" {{-- this is the model that will be updated --}}
            data-route="{{ route('admin.inline-edit') }}"
            data-validation-type="required"
            data-error-msg="This field is required"
        >
            {{ $data->name }}
        </strong>

        <a class="text-primary tnr-inline-edit inline-edit-trigger d-none" data-target="#field-name-{{ $data->id }}" href="#" title="Edit field name"><i class="bi bi-pencil-square"></i></a>

        <span class="form-text text-muted fs-{{ $data->id }}2">
            Description:
            <span
                id="field-description-{{ $data->id }}"
                data-toggle="manual"
                data-name="description"  {{-- this is the table column name that will be updated with the new value --}}
                data-pk="{{ $data->id }}"  {{-- table row ID --}}
                data-check-exists="false"
                data-title="Field description"
                data-type="textarea"
                data-showbuttons="bottom"
                data-emptytext=""
                data-model="App^Models^ContactForm" {{-- this is the model that will be updated --}}
                data-route="{{ route('admin.inline-edit') }}"
            >
                {{ $data->description }}
            </span>

            <a class="text-primary tnr-inline-edit inline-edit-trigger d-none" data-target="#field-description-{{ $data->id }}" href="#" title="Edit field description"><i class="bi bi-pencil-square"></i></a>
        </span>

        <span class="form-text text-muted fs-{{ $data->id }}2">
            Notes:
            <span
                id="field-notes-{{ $data->id }}"
                data-toggle="manual"
                data-name="notes"   {{-- this is the table column name that will be updated with the new value --}}
                data-pk="{{ $data->id }}"   {{-- table row ID --}}
                data-check-exists="false"
                data-title="Notes"
                data-type="textarea"
                data-showbuttons="bottom"
                data-emptytext=""
                data-model="App^Models^ContactForm" {{-- this is the model that will be updated --}}
                data-route="{{ route('admin.inline-edit') }}"
            >
                {{ $data->notes }}
            </span>

            <a class="text-primary tnr-inline-edit inline-edit-trigger d-none" data-target="#field-notes-{{ $data->id }}" href="#" title="Edit field notes"><i class="bi bi-pencil-square"></i></a>
        </span>
    </td>
    <td class="text-center">
        <span class="badge badge-light">
            <i class="fas fa-columns"></i>
            <span
                data-check-exists="false"
                data-entity="contact_form"
                data-inputclass="custom-select"
                data-name="columns"
                data-pk="{{ $data->id }}"
                data-source='[@foreach(consecutiveNumbers(1, 12) as $number) {"value":{{ $number }},"text":{{ $number }}}, @endforeach]'
                data-title="Columns"
                data-toggle="manual"
                data-type="select"
                data-value="{{ $data->columns }}"
                id="field-columns-{{ $data->id }}"
                data-model="App^Models^ContactForm" {{-- this is the model that will be updated --}}
                data-route="{{ route('admin.inline-edit') }}"
            >
                {{ $data->columns }}
            </span>
        </span>

        <br />

        <a class="text-primary tnr-inline-edit inline-edit-trigger d-none" data-target="#field-columns-{{ $data->id }}" href="#" title="Edit columns number"><i class="bi bi-pencil-square"></i></a>
    </td>
    <td class="col-md-4">
        <div class="custom-control custom-switch custom-switch-square custom-control-info">
            <input
                type="checkbox"
                class="custom-control-input tnr-xhr"
                data-call-method="change"
                data-xhr="changeAttribute" {{-- this is the method that will be called --}}
                data-id="{{ $data->id }}" {{-- table row ID --}}
                data-attribute="name_as_placeholder" {{-- this is the table column name that will be updated with the new value --}}
                data-model="App^Models^ContactForm" {{-- this is the model that will be updated --}}
                data-route="{{ route('admin.change-attribute') }}"
                name="active"
                id="field-name_as_placeholder-{{ $data->id }}"
                value="1" {{ (string) $data->name_as_placeholder === '1' ? 'checked' : '' }}
            >
            <label class="custom-control-label" for="field-name_as_placeholder-{{ $data->id }}">as placeholder</label>
        </div>

        <div class="custom-control custom-switch custom-switch-square custom-control-info mt-1">
            <input
                type="checkbox"
                class="custom-control-input tnr-xhr"
                data-call-method="change"
                data-xhr="changeAttribute" {{-- this is the method that will be called --}}
                data-id="{{ $data->id }}" {{-- table row ID --}}
                data-attribute="required" {{-- this is the table column name that will be updated with the new value --}}
                data-model="App^Models^ContactForm" {{-- this is the model that will be updated --}}
                data-route="{{ route('admin.change-attribute') }}"
                name="required"
                id="field-required-{{ $data->id }}"
                value="1" {{ (string) $data->required === '1' ? 'checked' : '' }}
            >
            <label class="custom-control-label" for="field-required-{{ $data->id }}">is required</label>
        </div>

        <div class="custom-control custom-switch custom-switch-square custom-control-info mt-1">
            <input
                type="checkbox"
                class="custom-control-input tnr-xhr"
                data-call-method="change"
                data-xhr="changeAttribute" {{-- this is the method that will be called --}}
                data-id="{{ $data->id }}" {{-- table row ID --}}
                data-attribute="active" {{-- this is the table column name that will be updated with the new value --}}
                data-model="App^Models^ContactForm" {{-- this is the model that will be updated --}}
                data-route="{{ route('admin.change-attribute') }}"
                name="active"
                id="field-active-{{ $data->id }}"
                value="1" {{ (string) $data->active === '1' ? 'checked' : '' }}
            >
            <label class="custom-control-label" for="field-active-{{ $data->id }}">is active</label>
        </div>
    </td>
    <td class="text-center">
        <a
            class="text-danger tnr-xhr"
            data-id="{{ $data->id }}"
            data-popup="tooltip"
            data-call-method="click"
            data-prevent
            data-xhr="deleteContactField"
            data-route="{{ route('admin.settings.delete.contact.field', $data) }}"
            href="#"
            title="Delete"
        >
            <i class="bi bi-trash"></i>
        </a>
    </td>
</tr>
