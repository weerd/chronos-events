<?php

function timezone_identifiers()
{
    return \DateTimeZone::listIdentifiers();
}

function timezone_identifier_options($oldTimezone, $eventTimezone = null)
{
    if ($oldTimezone) {
        $selectedTimezone = $oldTimezone;
    } elseif ($eventTimezone) {
        $selectedTimezone = $eventTimezone;
    } else {
        $selectedTimezone = config('chronosevents.timezone') ?: 'America/New_York';
    }

    return collect(timezone_identifiers())->map(function ($item) use ($selectedTimezone) {
        return [
            'identifier' => $item,
            'selected' => $item === $selectedTimezone ? true : false,
        ];
    })->all();
}
