@extends('layouts.default')
<div>
    <form action="{{ route('update', $note ? $note->id : null) }}" method="POST">
        @csrf
        @method('POST')
        <label for="name">Poznámka</label>
        <label>
            <input type="text" name="name" value="{{ $note ? $note->name : null }}">
        </label>
        <label for="content">Text</label>
        <label>
            <input type="text" name="content" value="{{ $note ? $note->content : null }}">
        </label>
        <label for="priority">Priorita</label>
        <label>
            <select name="priority">
                <option value="1" {{ $note && $note->priority == 1 ? 'selected' : null }}>Nízká</option>
                <option value="2" {{ $note && $note->priority == 2 ? 'selected' : null }}>Střední</option>
                <option value="3" {{ $note && $note->priority == 3 ? 'selected' : null }}>Vysoká</option>
            </select>
        </label>
        <button type="submit">Uložit</button>
    </form>
</div>
