<tr class="tnr-show-inline-edits" data-entry-id="{{ $data->id }}" id="row-{{ $data->id }}">
    <td>
        <i class="bi bi-arrow-down-up text-primary cursor-move tnr-sort-handle"></i>
    </td>
    <td class="text-center"><i class="{{ $data->type->icon }}" data-popup="tooltip" title="{{ $data->type->name }}"></i></td>
    <td>
        <span
            id="value-{{ $data->id }}"
            data-toggle="manual"
            data-name="value" {{-- this is the table column name that will be updated with the new value --}}
            data-pk="{{ $data->id }}" {{-- table row ID --}}
            data-check-exists="true" {{-- check if the value already exists in the table --}}
            data-title="Value"
            data-model="App^Models^ContactOption" {{-- this is the model that will be updated --}}
            data-route="{{ route('admin.inline-edit') }}"
            data-validation-type="required"
            data-error-msg="This field is required"
        >
            {{ $data->value }}
        </span>
        <a class="text-primary tnr-inline-edit inline-edit-trigger d-none" data-target="#value-{{ $data->id }}" href="#" title="Edit"><i class="bi bi-pencil-square"></i></a>

        @if($data->type->id === 10)
            <a class="text-primary inline-edit-trigger d-none" data-toggle="modal" href="#map-edit-{{ $data->id }}" title="Change the position on the map"><i class="fas fa-map-marker-alt"></i></a>
        @endif
    </td>
    <td>
        <div class="custom-control custom-switch custom-switch-square custom-control-info">
            <input
                type="checkbox"
                class="custom-control-input tnr-xhr"
                data-call-method="change"
                data-xhr="changeAttribute" {{-- this is the method that will be called --}}
                data-id="{{ $data->id }}" {{-- table row ID --}}
                data-attribute="active" {{-- this is the table column name that will be updated with the new value --}}
                data-model="App^Models^ContactOption" {{-- this is the model that will be updated --}}
                data-route="{{ route('admin.change-attribute') }}"
                name="active"
                id="active-{{ $data->id }}"
                value="1" {{ (string) $data->active === '1' ? 'checked' : '' }}
            >
            <label class="custom-control-label" for="active-{{ $data->id }}">active</label>
        </div>
    </td>
    <td>
        <a
            class="text-danger tnr-xhr"
            data-id="{{ $data->id }}"
            data-popup="tooltip"
            data-call-method="click"
            data-prevent
            data-xhr="deleteContactOption"
            data-route="{{ route('admin.settings.delete.contact.method', $data) }}"
            href="#"
            title="Delete"
        >
            <i class="bi bi-trash"></i>
        </a>
    </td>
</tr>

@if($data->type->id === 10)

@endif
