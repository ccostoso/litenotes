@props(['note'])


<p class="opacity-70">
    <strong>Created:</strong> {{ $note->created_at->diffForHumans() }}
</p>
<p class="opacity-70 ml-8">
    <strong>Updated:</strong> {{ $note->updated_at->diffForHumans() }}
</p>

<a href="{{ route('notes.edit', $note) }}" class="btn-link ml-auto">Edit Note</a>
<form action="{{ route('notes.destroy', $note) }}" method="post">
    @method('delete')
    @csrf
    <button type="submit" class="btn btn-danger ml-4" onclick="return confirm('Are you sure you want to move this to trash?')">Move to Trash</button>
</form>