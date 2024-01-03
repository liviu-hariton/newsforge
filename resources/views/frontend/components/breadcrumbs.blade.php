@if(!empty($breadcrumbs))
    <div class="breadcrumb-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house"></i></a></li>

                        @foreach($breadcrumbs as $anchor=>$url)
                            {{-- if $anchor is not an integer or if $url is an integer, and if either condition is true, it generates the link --}}
                            <li class="breadcrumb-item {{ !is_int($anchor) || is_int($url) ? '' : 'active' }}" {!! !is_int($anchor) || is_int($url) ? '' : 'aria-current="page"' !!}>
                                @if(!is_int($anchor) || is_int($url))
                                    <a href="{{ $url }}">{{ $anchor }}</a>
                                @else
                                    {{-- If the $url is an integer, then it's the last breadcrumb --}}
                                    {{ $url }}
                                @endif
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endif
