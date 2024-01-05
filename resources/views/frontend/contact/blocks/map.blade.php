@if($_tnrs->show_contact_map)
    <div id="contact-map-container" class="contact-map mt-5"></div>
@endif

@if(isset($_tnrs->google_maps_api_key))
    @push('scripts')
        <script src="https://maps.googleapis.com/maps/api/js?key={{ $_tnrs->google_maps_api_key }}"></script>

        <script>
            function initContactMap() {
                const _contact_map_position = {
                    lat: {{ $_tnrs->latitude }},
                    lng: {{ $_tnrs->longitude }}
                };

                const _contact_map = new google.maps.Map(document.getElementById('contact-map-container'), {
                        zoom: 12,
                        center: _contact_map_position
                    }
                );

                const marker = new google.maps.Marker({
                    position: _contact_map_position,
                    map: _contact_map,
                    draggable: false,
                    animation: google.maps.Animation.DROP
                });
            }

            $(document).ready(function () {
                initContactMap();
            });
        </script>
    @endpush
@endif
