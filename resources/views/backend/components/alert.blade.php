<div class="alert alert-{{ $type }} {{ $outlined ? 'alert-outlined' : '' }} {{ $dismissible ? 'alert-dismissible fade show' : '' }} {{ $icon !== '' ? 'alert-icon' : '' }}">
    @if( $icon !== '' )
    <i class="mdi {{ $icon }}"></i>
    @endif

    {!! $message !!}

    @if( $dismissible )
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    @endif
</div>
