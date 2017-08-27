@extends('chronos-events::layouts.client.master')

@section('content')

    <h1>{{ $event->title }}</h1>

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

@endsection
