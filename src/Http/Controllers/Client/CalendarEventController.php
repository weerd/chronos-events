<?php

namespace Weerd\ChronosEvents\Http\Controllers\Client;

use Weerd\ChronosEvents\Http\Controllers\Controller as BaseController;

class CalendarEventController extends BaseController
{
    public function __construct()
    {
        $this->middleware(['web']);
    }

    public function index()
    {
        return 'why hello there list of events';
    }

    public function show()
    {
        return 'why hello there single event';
    }
}
