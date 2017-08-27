@extends('chronos-events::layouts.admin.master')

@section('content')

    <h1>Admin: Update Calendar Event</h1>

    <form method="POST" action="{{ route('admin.events.update', $event->id) }}">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        @if (count($errors) > 0)
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="{{ $event->title or old('title') }}" autofocus />
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="10" cols="50">{{ $event->description or old('description') }}</textarea>
        </div>

        <div>
            <fieldset>
                <legend>Event Start:</legend>

                <label for="start_date">Date:</label>
                <input type="date" id="start_date" name="start_date" value="{{ $event->start_date_string or old('start_date') }}" />

                <label for="start_time">Time:</label>
                <input type="time" id="start_time" name="start_time" value="{{ $event->start_time_string or old('start_time') }}" />

                <label for="start_timezone">Timezone:</label>
                <select name="start_timezone" id="start_timezone">
                    @foreach(timezone_identifier_options(old('start_timezone'), $event->start_timezone) as $timezone)
                        <option value="{{ $timezone['identifier'] }}" {{ $timezone['selected'] ? 'selected' : null }}>{{ $timezone['identifier'] }}</option>
                    @endforeach
                </select>
            </fieldset>
        </div>

        <div>
            <fieldset>
                <legend>Event End:</legend>

                <label for="end_date">Date:</label>
                <input type="date" id="end_date" name="end_date" value="{{ $event->end_date_string or old('end_date') }}" />

                <label for="end_time">Time:</label>
                <input type="time" id="end_time" name="end_time" value="{{ $event->end_time_string or old('end_time') }}" />

                <label for="end_timezone">Timezone:</label>
                <select name="end_timezone" id="end_timezone">
                    @foreach(timezone_identifier_options(old('end_timezone'), $event->start_timezone) as $timezone)
                        <option value="{{ $timezone['identifier'] }}" {{ $timezone['selected'] ? 'selected' : null }}>{{ $timezone['identifier'] }}</option>
                    @endforeach
                </select>
            </fieldset>
        </div>

        <div>
            <input type="checkbox" id="all_day" name="all_day" {{ $event->all_day or old('all_day') ? 'checked' : null }}>
            <label for="all_day">All Day Event</label>
        </div>

        <div>
            <input type="submit" value="Update">
            <a href="{{ route('admin.events.index') }}">Cancel</a>
        </div>
    </form>

@endsection
