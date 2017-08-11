<?php

namespace Weerd\ChronosEvents\Http\Controllers\Admin;

use Weerd\ChronosEvents\Http\Controllers\Controller as BaseController;

class CalendarEventController extends BaseController
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        return 'why hello there events';
    }
}
