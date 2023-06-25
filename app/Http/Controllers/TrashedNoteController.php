<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TrashedNoteController extends Controller
{
    public function index() {
        $notes = Note::whereBelongsTo(Auth::user())->onlyTrashed()->latest('updated_at')->paginate(15);
        return view('notes.index')->with('notes', $notes);
    }

    public function show(Note $note) {
        // return view('notes.show')->with('note', $note);
        return view('notes.show')->with([
            'note' => $note,
            'response'=> Gate::inspect('view-note', $note)
        ]);
    }

    public function update(Note $note) {
        $note->restore();

        return to_route('notes.show', $note)->with('success', 'Note restored successfully!');
    }

    public function destroy(Note $note) {
        $note->forceDelete();

        return to_route('trashed.index')->with([
            'notes' => $note,
            'success' => 'Note deleted successfully!'
        ]);
    }
}
