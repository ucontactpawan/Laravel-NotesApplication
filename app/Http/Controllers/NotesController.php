<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function __construct()
    {
        // Add some sample notes if none exist
        if (!session()->has('notes') || empty(session('notes'))) {
            $sampleNotes = [
                1 => [
                    'note' => 'Welcome to your Notes App! This is your first sample note. You can edit or delete this note, or create new ones.',
                    'user_id' => 1,
                    'created_at' => now()->subHours(2)->toDateTimeString(),
                    'updated_at' => now()->subHours(2)->toDateTimeString(),
                ],
                2 => [
                    'note' => 'This is another sample note to show you how the app works. Try creating, editing, and deleting notes!',
                    'user_id' => 1,
                    'created_at' => now()->subHour()->toDateTimeString(),
                    'updated_at' => now()->subHour()->toDateTimeString(),
                ],
            ];
            session(['notes' => $sampleNotes]);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // For demo purposes, using session storage
        $notes = collect(session('notes', []))
            ->sortKeysDesc() // Sort by keys in descending order (newest first)
            ->map(function ($noteData, $id) {
                return (object) array_merge($noteData, ['id' => $id]);
            })
            ->values();

        return view('notes.index', compact('notes'));
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
            'note' => 'required|min:1|max:2000'
        ]);

        $notes = session('notes', []);
        $id = empty($notes) ? 1 : max(array_keys($notes)) + 1;

        $notes[$id] = [
            'note' => $request->note,
            'user_id' => 1,
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString(),
        ];

        session(['notes' => $notes]);

        return redirect()->route('notes.index')->with('success', 'Note created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $notes = session('notes', []);

        if (!isset($notes[$id])) {
            abort(404);
        }

        $note = (object) array_merge($notes[$id], ['id' => $id]);
        return view('notes.show', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $notes = session('notes', []);

        if (!isset($notes[$id])) {
            abort(404);
        }

        $note = (object) array_merge($notes[$id], ['id' => $id]);
        return view('notes.edit', compact('note'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'note' => 'required|min:1|max:2000'
        ]);

        $notes = session('notes', []);

        if (!isset($notes[$id])) {
            abort(404);
        }

        $notes[$id]['note'] = $request->note;
        $notes[$id]['updated_at'] = now()->toDateTimeString();

        session(['notes' => $notes]);

        return redirect()->route('notes.index')->with('success', 'Note updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $notes = session('notes', []);

        if (!isset($notes[$id])) {
            abort(404);
        }

        unset($notes[$id]);
        session(['notes' => $notes]);

        return redirect()->route('notes.index')->with('success', 'Note deleted successfully!');
    }
}
