<tr>
    <td colspan="6" class="disable-row-hover">
        <div class="email-right-header mb-5">
            <div class="head-left-options">
                {{-- Select all checkbox --}}
                <div class="form-check">
                    <div class="custom-checkbox">
                        <input
                            type="checkbox"
                            class="custom-control-input tnr-bulk-select"
                            data-set=".contact-bulk-item"
                            data-table="#contacts-bulk-set"
                            id="bulk-all"
                        >
                        <label class="custom-control-label" for="bulk-all">Select All</label>
                    </div>
                </div>

                {{-- Bulk actions on the selected items --}}
                <div class="dropdown">
                    <button class="btn dropdown-toggle border rounded-pill" type="button" id="dropdownMenuButton" data-toggle="dropdown">Actions</button>
                    <div class="dropdown-menu dropdown-menu-button">
                        <a
                            class="dropdown-item tnr-xhr"
                            href="#"
                            data-prevent
                            data-targets=".contact-bulk-item"
                            data-call-method="click"
                            data-xhr="bulkMarkContactsAsRead"
                            data-value="1"
                            data-attribute="is_read"
                            data-model="App^Models^Contact"
                            data-css-toggle="unread|read"
                            data-route="{{ route('admin.change-attribute') }}"
                        >
                            <i class="far fa-envelope-open"></i> Mark as read
                        </a>
                        <a
                            class="dropdown-item tnr-xhr"
                            href="#"
                            data-prevent
                            data-targets=".contact-bulk-item"
                            data-call-method="click"
                            data-xhr="bulkMarkContactsAsRead"
                            data-value="0"
                            data-attribute="is_read"
                            data-model="App^Models^Contact"
                            data-css-toggle="read|unread"
                            data-route="{{ route('admin.change-attribute') }}"
                        >
                            <i class="far fa-envelope"></i> Mark as unread
                        </a>
                        <div class="dropdown-submenu">
                            <a href="#" class="dropdown-item"><i class="mdi mdi-checkbox-blank-circle-outline"></i> Set label</a>
                            <div class="dropdown-menu">
                                @foreach($contact_labels as $contact_label)
                                <a
                                    class="dropdown-item tnr-xhr"
                                    href="#"
                                    data-prevent
                                    data-targets=".contact-bulk-item"
                                    data-call-method="click"
                                    data-xhr="bulkSetContactFormLabel"
                                    data-label-id="{{ $contact_label->id }}"
                                    data-route="{{ route('admin.bulk-set-contact-form-label') }}"
                                >
                                    <i class="mdi mdi-checkbox-blank-circle-outline" style="color: {{ $contact_label->color }};"></i> {{ $contact_label->name }}
                                </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a
                            class="dropdown-item text-danger tnr-xhr"
                            href="#"
                            data-prevent
                            data-targets=".contact-bulk-item"
                            data-call-method="click"
                            data-xhr="bulkDeleteContacts"
                            data-route="{{ route('admin.bulk-delete-contacts') }}"
                        >
                            <i class="fas fa-trash-alt"></i> Delete
                        </a>
                    </div>
                </div>
            </div>

            <div class="head-right-options">
                <div class="btn-group" role="group" aria-label="Basic example">
                    @if($contacts->currentPage() > 1)
                        <a href="{{ $contacts->previousPageUrl() }}" data-popup="tooltip" title="Previous page" class="btn border btn-pill">
                            <i class="mdi mdi-chevron-left"></i>
                        </a>
                    @endif
                    @if($contacts->hasMorePages())
                        <a href="{{ $contacts->nextPageUrl() }}" data-popup="tooltip" title="Next page" class="btn border btn-pill">
                            <i class="mdi mdi-chevron-right"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </td>
</tr>
