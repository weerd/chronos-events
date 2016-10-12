<?php

use Weerd\TitanEvents\Models\CalendarEvent;

class CalendarEventTest extends TestCase
{
    /** @test */
    public function testCreateCalendarEvent()
    {
        $this->makeCalendarEvent();
    }
}
