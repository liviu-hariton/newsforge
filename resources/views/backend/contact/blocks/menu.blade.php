<div class="email-left-column email-options p-4 p-xl-5">
    <ul class="pb-2">
        <li class="d-block active mb-4">
            <a href="{{ route('admin.contact.index') }}"><i class="mdi mdi-download mr-2"></i> Inbox</a>
            <span class="badge badge-danger">{{ $unread_contacts_count }}</span>
        </li>
        <li class="d-block mb-4">
            <a href="#"><i class="mdi mdi-playlist-edit mr-2"></i> Drafts</a>
        </li>
        <li class="d-block mb-4">
            <a href="#"><i class="mdi mdi-open-in-new mr-2"></i> Sent replies</a>
        </li>
        <li class="d-block mb-4">
            <a href="#"><i class="mdi mdi-trash-can-outline mr-2"></i> Trash</a>
        </li>
    </ul>

    <p class="text-dark font-weight-medium">Labels</p>

    <ul id="my-contact-labels">
        @foreach($contact_labels as $contact_label)
        <li class="mt-4">
            <a href="#"><i class="mdi mdi-checkbox-blank-circle-outline mr-3" style="color: {{ $contact_label->color }};"></i> {{ $contact_label->name }}</a>
        </li>
        @endforeach
    </ul>

    <hr />
    <a href="#new-contact-label" data-toggle="modal" class="text-primary"><i class="bi bi-plus"></i> create a new label</a>
</div>

<div id="new-contact-label" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('admin.add-contact-label') }}" name="f-new-contact-label" id="f-new-contact-label" class="tnr-ays">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Add new contact label</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="label-name">Label name:</label>
                        <input type="text" class="form-control" name="name" id="label-name" value="{{ old('name') }}">

                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="label-name">Label color:</label>
                        <input type="color" class="form-control" name="color" id="label-color" value="{{ old('color', '#894DD9') }}">

                        @error('color')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" id="save_form_data" class="btn btn-success btn-labeled btn-labeled-right">
                        <b><i class="fas fa-check"></i></b> Add label
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@if( session()->has('open-new-contact-label-modal') )
    <script>
        $(document).ready(function() {
            $('#new-contact-label').modal('show');
        });
    </script>
@endif
