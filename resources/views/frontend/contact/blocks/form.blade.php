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
