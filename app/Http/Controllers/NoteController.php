<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        $query = Note::query();

        if ($request->has('orderWay') && $request->has('orderBy')) {
            $query->orderBy($request->query('orderBy'), $request->query('orderWay'));
        } else {
            $query->orderBy('priority', 'desc');
        }

        return view('index', [
            'notes' => []
        ]);
    }

    public function create()
    {
        return view('edit', [
            'note' => new Note()
        ]);
    }

    public function show(int $id = null)
    {
        if ($id) {
            $note = Note::find($id);
            if (!$note) {
                return redirect()->route('index', ['error' => 'Poznámka nebyla nalezena']);
            }
        } else {
            $note = new Note();
        }

        return view('show', [
            'note' => $note
        ]);
    }

    public function store(Request $request, int $id = null)
    {
        if ($id) {
            $note = Note::find($id);
            if (!$note) {
                return redirect()->route('index', ['error' => 'Poznámka nebyla nalezena']);
            }
        } else {
            $note = new Note();
        }
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'content' => 'required',
            'priority' => 'required|integer|min:1|max:3'
        ]);

        if ($validator->fails()) {
            return redirect()->route('show', ['id' => $id])->withErrors($validator);
        }

        $note->fill($request->all());
        $note->save();

        return redirect()->route('index', ['success' => 'Poznámka byla uložena']);
    }

    public function destroy(int $id)
    {
        if (!$id) {
            return redirect()->route('index', ['error' => 'Poznámka nebyla nalezena']);
        }

        $note = Note::find($id);
        if (!$note) {
            return redirect()->route('index', ['error' => 'Poznámka nebyla nalezena']);
        }

        $note->delete();

        return redirect()->route('index', ['success' => 'Poznámka byla smazána']);
    }
}
