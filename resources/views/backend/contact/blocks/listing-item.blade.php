<tr class="{{ $data->is_read ? 'read' : 'unread' }}" id="contact-row-{{ $data->id }}">
    <td class="mark-mail">
        <div class="custom-control custom-checkbox d-inline-block">
            <input type="checkbox" class="custom-control-input contact-bulk-item" id="bulk-{{ $data->id }}" value="{{ $data->id }}">
            <label class="custom-control-label" for="bulk-{{ $data->id }}">&nbsp;</label>
        </div>
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
                <a class="list-icons-item dropdown-toggle text-primary" data-toggle="dropdown" href="#"><i class="fas fa-ellipsis-v"></i></a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ route('admin.contact.show', $data) }}" class="dropdown-item"><i class="fas fa-search-plus"></i> View</a>
                    <a
                        class="dropdown-item tnr-xhr"
                        href="#"
                        data-prevent
                        data-id="{{ $data->id }}"
                        data-call-method="click"
                        data-xhr="changeAttribute"
                        data-attribute="is_read"
                        data-model="App^Models^Contact"
                        data-route="{{ route('admin.change-attribute') }}"
                        data-value="1"
                        data-css-toggle="unread|read|#contact-row-{{ $data->id }}"
                    >
                        <i class="far fa-envelope-open"></i> Mark as read
                    </a>
                    <a
                        class="dropdown-item tnr-xhr"
                        href="#"
                        data-prevent
                        data-id="{{ $data->id }}"
                        data-call-method="click"
                        data-xhr="changeAttribute"
                        data-attribute="is_read"
                        data-model="App^Models^Contact"
                        data-route="{{ route('admin.change-attribute') }}"
                        data-value="0"
                        data-css-toggle="read|unread|#contact-row-{{ $data->id }}"
                    >
                        <i class="far fa-envelope"></i> Mark as unread
                    </a>
                    <div class="dropdown-submenu">
                        <a href="#" class="dropdown-item"><i class="mdi mdi-checkbox-blank-circle-outline"></i> Set label</a>
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
