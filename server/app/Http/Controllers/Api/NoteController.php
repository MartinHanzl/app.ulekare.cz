<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NoteResource;
use App\Models\Note;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Note::query();

        if (request()->has('search')) {
            $query->where('title', 'like', '%' . request('search') . '%');
        }

        if ($request->has('orderWay') && $request->has('orderBy')) {
            $query->orderBy($request->get('orderBy'), $request->get('orderWay'));
        }

        return Response::json(NoteResource::collection($query->paginate(10)));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, int $id = null): JsonResponse
    {
        if ($id) {
            $note = Note::find($id);
            if (!$note) {
                return Response::json(['message' => 'Note not found'], 404);
            }
        } else {
            $note = new Note();
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'content' => 'required',
            'priority' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return Response::json($validator->errors(), 400);
        }

        DB::beginTransaction();
        try {
            $note->fill($request->all());
            $note->save();
            DB::commit();
        } catch (\Throwable|\Exception $e) {
            DB::rollBack();
            return Response::json(['message' => $e->getMessage()], 500);
        }

        return Response::json(NoteResource::make($note));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        if (!$id) {
            App::abort(404, 'Note not found');
        }

        $note = Note::find($id);
        if (!$note) {
            App::abort(404, 'Note not found');
        }

        return Response::json(NoteResource::make($note));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        if (!$id) {
            App::abort(404, 'Note not found');
        }

        $note = Note::find($id);
        if (!$note) {
            App::abort(404, 'Note not found');
        }

        $note->delete();

        return Response::json(['message' => 'Note deleted']);
    }
}
