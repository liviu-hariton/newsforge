<a
    href="#"
    class="dropdown-item tnr-xhr"
    data-id="{{ $contact->id }}"
    data-label-id="{{ $contact_label->id }}"
    data-call-method="click"
    data-prevent
    data-xhr="setContactFormLabel"
    data-route="{{ route('admin.set-contact-form-label') }}"
>
    <i class="mdi mdi-checkbox-blank-circle-outline" style="color: {{ $contact_label->color }};"></i> {{ $contact_label->name }}
</a>
