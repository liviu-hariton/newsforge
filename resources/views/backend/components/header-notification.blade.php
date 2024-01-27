<div class="media media-sm p-4 mb-0">
    <div class="media-sm-wrapper bg-primary">
        <a href="{{ $data['action'] }}">
            {!! $data['icon'] !!}
        </a>
    </div>
    <div class="media-body">
        <a href="{{ $data['action'] }}">
            <span class="title mb-0">{{ $data['title'] }}</span>
            <span class="describe">{{ $data['description'] }}</span>
            <span class="time">
                <time>{{ $data['created_ago'] }}</time>
            </span>
        </a>
    </div>
</div>
