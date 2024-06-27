{{-- <div class="card {{ !empty($variant) ? 'card-'.$variant : '' }} {{ !empty($outline) ? 'card-outline'.$outline : '' }} ">
    @if (!empty($title))
        <div class="card-header">
            <h3 class="card-title"> {{ $title }} </h3>
        </div>
    @endif

    @if (!empty($header))
        <div class="card-header">
            {!! $header !!}
        </div>
    @endif

    @if (!empty($body))
        <div class="card-body">
            {!! $body !!}
        </div>
    @endif

    @if (!empty($footer))
        <div class="card-footer">
            {!! $footer !!}
        </div>
    @endif
</div> --}}


<div class="card {{ !empty($variant) ? 'card-'.$variant : '' }} {{ !empty($outline) ? 'card-outline-'.$outline : '' }}">
    @if (!empty($title) || !empty($buttonText))
        <div class="card-header d-flex justify-content-between align-items-center">
            @if (!empty($title))
                <h3 class="card-title"> {{ $title }} </h3>
            @endif
            @if (!empty($buttonText) && !empty($buttonRoute))
                <a href="{{ $buttonRoute }}" class="btn btn-primary">{{ $buttonText }}</a>
            @endif
        </div>
    @endif

    @if (!empty($header))
        <div class="card-header">
            {!! $header !!}
        </div>
    @endif

    @if (!empty($body))
        <div class="card-body">
            {!! $body !!}
        </div>
    @endif

    @if (!empty($footer))
        <div class="card-footer">
            {!! $footer !!}
        </div>
    @endif
</div>
