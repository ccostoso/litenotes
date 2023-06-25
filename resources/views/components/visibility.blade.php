@props(['is_public'])

<p class="opacity-70">
    @if($is_public)
        <small>Visibility: <strong>Public</strong></small>
    @else
        <small>Visibility: <strong>Private</strong></small>
    @endif
</p>