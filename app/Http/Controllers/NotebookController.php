<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Notebook;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotebookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notebooks = Notebook::whereBelongsTo(Auth::user())->latest('updated_at')->paginate(15);
        return view('notebooks.index')->with('notebooks', $notebooks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $notes = Note::whereBelongsTo(Auth::user())->latest('updated_at')->paginate(15);
        return view('notebooks.create')->with('notes', $notes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Auth::user()->notebooks()->create([
            'uuid' => Str::uuid(),
            'title' => $request->title,
            'description' => $request->description
        ])->notes()->attach($request->in_notebook);

        return to_route('notebooks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
