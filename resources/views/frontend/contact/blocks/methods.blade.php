@if($_tnrs->show_contact_methods)
    <div class="col-lg-4">
        <h4 class="text-black mb-4">Contact us</h4>
        <p class="lead">These are the methods for contacting us</p>

        <ul class="list-unstyled">
            @foreach($contact_methods as $contact_method)
            <li class="mb-3 contact-method d-flex">
                <span class="fa-stack fa-2x">
                    <i class="fas fa-circle fa-stack-2x"></i>
                    <i class="{{ $contact_method->type->icon }} fa-stack-1x fa-inverse"></i>
                </span>
                <span class="contact-method-text">
                    <strong>{{ $contact_method->type->name }}</strong><br>
                    {{ $contact_method->value }}

                    @if($contact_method->type->id === 10 && $contact_method->latitude && $contact_method->longitude)
                    <br><a href="https://www.google.com/maps/dir/?api=1&amp;destination={{ $contact_method->latitude }},{{ $contact_method->longitude }}&amp;dir_action=navigate" target="_blank"><i class="fas fa-map-marker-alt"></i> View on map</a>
                    @endif
                </span>
            </li>
            @endforeach
        </ul>
    </div>
@endif
