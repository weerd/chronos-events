<?php

namespace Weerd\ChronosEvents\Http\Controllers\Client;

use Weerd\ChronosEvents\Http\Controllers\Controller as BaseController;

class CalendarEventController extends BaseController
{
    public function __construct()
    {
        //
    }

    public function show()
    {
        return 'why hello there single event';
    }
}
