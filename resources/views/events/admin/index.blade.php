@extends('chronos-events::layouts.admin.master')

@section('content')

    <h1>Admin: Calendar Events List</h1>

    <a href="{{ route('admin.events.create') }}">Add new calendar event</a>

    @if ($events->count())
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->start_date_string }}</td>
                        <td>{{ $event->end_date_string }}</td>
                        <td><a href="{{ route('client.events.show', $event->id) }}" target="_blank">View</a></td>
                        <td><a href="{{ route('admin.events.edit', $event->id) }}">Edit</a></td>
                        <td>
                            <form method="POST" action="{{ route('admin.events.destroy', $event->id) }}">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <input type="submit" value="Delete">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

@endsection
