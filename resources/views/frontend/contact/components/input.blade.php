<div class="col-md-{{ $data->columns }} col-12">
    <div class="form-group">
        @if($data->name_as_placeholder === 0)
        <label for="{{ $data->slug }}">{{ $data->name }}</label>
        @endif

        @if(!in_array($data->type->type, ['file', 'textarea']))
        <input
            class="form-control"
            name="{{ $data->slug }}"
            id="{{ $data->slug }}"
            type="{{ $data->type->type }}"
            {!! $data->name_as_placeholder === 1 ? 'placeholder="'.$data->name.'"' : '' !!}
            {{ $data->required === 1 ? 'required' : '' }}
            value="{{ old($data->slug) }}"
        >
        @endif

        @if($data->type->type === 'textarea')
        <textarea
            class="form-control"
            name="{{ $data->slug }}"
            id="{{ $data->slug }}"
            {!! $data->name_as_placeholder === 1 ? 'placeholder="'.$data->name.'"' : '' !!}
            {{ $data->required === 1 ? 'required' : '' }}
            rows="7"
        >{{ old($data->slug) }}</textarea>
        @endif

        @if($data->type->type === 'file')
        <div class="custom-file">
            <input
                class="custom-file-input"
                type="{{ $data->type->type }}"
                name="{{ $data->slug }}"
                id="{{ $data->slug }}"
                {{ $data->required === 1 ? 'required' : '' }}
                {!! $data->extensions ? 'accept="'.$data->extensions.'"' : '' !!}
            >
            @if($data->name_as_placeholder === 1)
            <label class="custom-file-label" for="customFile">{{ $data->name }}</label>
            @else
            <label class="custom-file-label" for="customFile">Choose file</label>
            @endif
        </div>
        @endif

        @if($data->description)
        <span class="form-text text-muted">{{ $data->description }}</span>
        @endif
    </div>
</div>
