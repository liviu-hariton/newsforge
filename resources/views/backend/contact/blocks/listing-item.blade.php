<tr class="{{ $data->is_read ? 'read' : 'unread' }}" id="field-row-{{ $data->id }}">
    <td class="mark-mail">
        <label class="control control-checkbox mb-0">
            <input type="checkbox"/>
            <div class="control-indicator"></div>
        </label>
    </td>
    <td class="sender-name text-dark goto {{ $data->is_read ? '' : 'font-weight-bold' }}"
        data-url="{{ route('admin.contact.show', $data) }}">
        {{ $data->from_name }}<br>
        <small class="text-smoke">&lt;{{ $data->from_email }}&gt;</small>
    </td>
    <td class="goto" data-url="{{ route('admin.contact.show', $data) }}">
        <a href="{{ route('admin.contact.show', $data) }}" class="text-default d-inline-block text-smoke">
            <span class="subject text-dark {{ $data->is_read ? '' : 'font-weight-bold' }}">{{ $data->subject }}</span>
            - {{ $data->message }}
        </a>

        <div class="labels" id="labels-{{ $data->id }}">
            @foreach($data->labels as $label)
                @include('backend.contact.blocks.label', ['label' => $label])
            @endforeach
        </div>
    </td>
    <td class="attachment goto" data-url="{{ route('admin.contact.show', $data) }}">
        @if($data->attachments)
            <i class="mdi mdi-paperclip" data-popup="tooltip" title="Has attachments"></i>
        @endif
    </td>
    <td class="date goto" data-url="{{ route('admin.contact.show', $data) }}">
        {{ $data->created_at->format('d M') }}
    </td>
    <td class="text-center">
        <div class="list-icons">
            <div class="dropdown" data-boundary="window">
                <a class="list-icons-item dropdown-toggle text-primary" data-toggle="dropdown" href="#"><i
                        class="fas fa-ellipsis-v"></i></a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ route('admin.contact.show', $data) }}" class="dropdown-item"><i
                            class="fas fa-search-plus"></i> View</a>
                    <div class="dropdown-submenu">
                        <a href="#" class="dropdown-item">Set label</a>
                        <div class="dropdown-menu dropdown-submenu-left">
                            @foreach($contact_labels as $contact_label)
                                @include('backend.contact.blocks.set-label', ['contact' => $data, 'contact_label' => $contact_label])
                            @endforeach
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a
                        href="#"
                        class="text-danger dropdown-item tnr-xhr"
                        data-id="{{ $data->id }}"
                        data-popup="tooltip"
                        title="Delete"
                        data-call-method="click"
                        data-prevent
                        data-xhr="deleteContactForm"
                        data-route="{{ route('admin.contact.destroy', $data) }}"
                    >
                        <i class="fas fa-trash-alt"></i> Delete
                    </a>
                </div>
            </div>
        </div>
    </td>
</tr>
