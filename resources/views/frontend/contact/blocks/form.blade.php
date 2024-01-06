@if($_tnrs->show_contact_form)
    <div class="col-md-8">
        <h3 class="mb-3">Contact form</h3>
        <p>Feel free to contact us by filling up the form bellow</p>

        <form method="post" action="{{ route('contact.store') }}" name="f-contact" id="f-contact" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                @foreach($contact_form_fields as $contact_form_field)
                    @include('frontend.contact.components.input', ['data' => $contact_form_field])
                @endforeach
            </div>

            <button class="btn btn-primary solid blank mt-3" type="submit" id="go-contact">Send Message</button>
        </form>
    </div>
@endif

@push('scripts')
<script>
    $(document).ready(function () {
        if(!$().validate) {
            console.warn('Warning - validate.min.js is not loaded.');
        } else {
            $("#f-contact").validate({
                errorClass: 'validation-invalid-label',
                successClass: 'validation-valid-label',
                validClass: 'validation-valid-label',
                highlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                unhighlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                },
                submitHandler: function(form) {
                    form.submit();
                },
                rules: {
                    @foreach($contact_form_fields as $contact_form_field)

                    {{ $contact_form_field->slug }}: {
                        @if($contact_form_field->required === 1)
                        required: true,
                        @endif

                        @if($contact_form_field->type->type === 'email')
                        email: true,
                        @endif

                        @if($contact_form_field->type->type === 'url')
                        url: true,
                        @endif

                        @if($contact_form_field->type->type === 'number')
                        digits: true,
                        @endif

                        @if($contact_form_field->type->type === 'date')
                        dateISO: true,
                        @endif

                        @if($contact_form_field->type->type !== 'file')
                        minlength: "{{ $contact_form_field->min_length }}",
                        maxlength: "{{ $contact_form_field->max_length }}",
                        @endif

                        @if($contact_form_field->type->type === 'file')
                        accept: "{{ $contact_form_field->extensions }}",
                        @endif
                    },

                    @endforeach
                },
                messages: {
                    @foreach($contact_form_fields as $contact_form_field)
                    @if($contact_form_field->type->type === 'file')
                    {{ $contact_form_field->slug }}: {
                        accept: "Please select files of type {{ $contact_form_field->extensions }}",
                    }
                    @endif
                    @endforeach
                }
            });
        }
    });
</script>
@endpush
