@extends('layouts.default')
<div>
    <a href="{{ route('poznamka') }}">Přidat poznámku</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Poznámka</th>
            <th>Text</th>
            <th>Priorita</th>
        </tr>
        @foreach($notes as $note)
        <tr>
            <td>{{ $note->id }}</td>
            <td>{{ $note->name }}</td>
            <td>{{ $note->content }}</td>
            <td>{{ $note->priority }}</td>
            <td>
                <a href="{{ route('show', $note->id) }}">Show</a>
                <a href="{{ route('edit', $note->id) }}">Edit</a>
                <form action="{{ route('destroy', $note->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
</div>
