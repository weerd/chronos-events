@extends('chronos-events::layouts.admin.master')

@section('content')

    <h1>Admin: Calendar Events List</h1>

    <a href="{{ route('admin.events.create') }}">Add new calendar event</a>

    @if ($events->count())
        <ul>
            @foreach ($events as $event)
                <li>
                    {{ $event->title }}
                    <a href="{{ route('admin.events.edit', $event->id) }}">Edit</a>
                </li>
            @endforeach
        </ul>
    @endif

@endsection
