<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $notes = Note::where('user_id', Auth::id())->latest('updated_at')->paginate(15);
        // $notes = Auth::user()->notes()->latest('updated_at')->paginate(15);
        $notes = Note::whereBelongsTo(Auth::user())->latest('updated_at')->paginate(15);
        return view('notes.index')->with('notes', $notes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:250',
            'text' => 'required'
        ]);

        Auth::user()->notes()->create([
            'uuid' => Str::uuid(),
            'title' => $request->title,
            'text' => $request->text
        ]);

        return to_route('notes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Note $note)
    {
        // $request = Gate::inspect('view-note', $note);

        return view('notes.show')->with([
            'note' => $note,
            'response'=> Gate::inspect('view-note', $note)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        return view('notes.edit')->with([
            'note' => $note,
            'response'=> Gate::inspect('view-note', $note)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        // dd($request);

        $request->validate([
            'title' => 'required|max:250',
            'text' => 'required',
        ]);

        $note->update([
            'title' => $request->title,
            'text' => $request->text,
            'is_public' => (bool) $request->is_public,
        ]);

        return to_route('notes.show', $note)->with('success', 'Note updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $note->delete();

        return to_route('notes.index')->with('success', 'Note moved to Trash!');
    }
}
