@extends('chronos-events::layouts.client.master')

@section('content')

    <h1>Calendar Events List</h1>

    @if ($events->count())
        <ul>
            @foreach ($events as $event)
                <li>
                    <h2><a href="{{ route('client.events.show', $event->id) }}">{{ $event->title }}</a></h2>

                    @if ($event->all_day)
                        <div>
                            {{ $event->start->format('l, F jS, Y') }}
                        </div>
                    @else
                        <div>
                            {{ $event->start->format('l, F jS, Y \\a\\t h:i a T') }} &mdash; {{ $event->end->format('l, F jS, Y \\a\\t h:i a T') }}
                        </div>
                    @endif

                    <p>{{$event->description }}</p>
                </li>
            @endforeach
        </ul>
    @endif

@endsection
