@props(['note'])

<p class="opacity-70">
    <strong>Deleted:</strong> {{ $note->deleted_at->diffForHumans() }}
</p>
<form action="{{ route('trashed.update', $note) }}" method="post" class="ml-auto">
    @method('put')
    @csrf
    <button type="submit" class="btn-link">Restore Note</button>
</form>
<form action="{{ route('trashed.destroy', $note) }}" method="post">
    @method('delete')
    @csrf
    <button type="submit" class="btn btn-danger ml-4" onclick="return confirm('Are you sure you want to delete this note permanently? This action cannot be undone.')">Delete Permanently</button>
</form>