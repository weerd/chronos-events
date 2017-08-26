<?php

use Carbon\Carbon;

/**
 * List of timezone identifiers.
 *
 * @return array
 */
function timezone_identifiers()
{
    return \DateTimeZone::listIdentifiers();
}

/**
 * List of timezone identifier options for use in form select elements.
 *
 * @param  string|null $oldTimezone
 * @param  string|null $eventTimezone
 * @return array
 */
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

/**
 * Convert supplied date, time and timezone to UTC Carbon instance.
 *
 * @param  string $date
 * @param  string $time
 * @param  string $timezone
 * @return Carbon\Carbon
 */
function utc_date_time($date, $time, $timezone)
{
    return Carbon::parse($date . ' ' . $time, $timezone)->timezone('utc');
}
