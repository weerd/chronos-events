<?php

use Weerd\ChronosEvents\Models\CalendarEvent;

class CalendarEventTest extends TestCase
{
    /** @test */
    public function testCreateCalendarEvent()
    {
        $this->makeCalendarEvent();
    }
}
