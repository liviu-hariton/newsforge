<div class="card card-default">
    <div class="card-header">
        <h2>My profile</h2>
    </div>

    <div class="card-body pt-0">
        <div class="my-profile-image mb-5 text-center">
            <img
                @if(auth()->user()->adminProfile->avatar)
                src="{{ url('storage/'.auth()->user()->adminProfile->avatar) }}"
                @else
                src="https://placehold.co/200"
                @endif
                class="rounded-circle"
                alt="{{ auth()->user()->adminProfile->firstname }} {{ auth()->user()->adminProfile->lastname }}"
            >
        </div>

        <ul class="nav nav-settings">
            @foreach(adminUserProfileSections() as $profile_section_key=>$profile_section_properties)
            <li class="nav-item">
                <a
                    class="nav-link {{ menuItemActive(['admin.profile.'.$profile_section_key]) ? 'active' : '' }}"
                    href="{{ route('admin.profile.'.$profile_section_key) }}"
                >
                    {!! $profile_section_properties['icon'] !!} {{ $profile_section_properties['name'] }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
