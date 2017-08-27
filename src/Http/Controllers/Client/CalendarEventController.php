<?php

namespace Weerd\ChronosEvents\Http\Controllers\Client;

use Weerd\ChronosEvents\Models\ChronosEvent as Event;
use Weerd\ChronosEvents\Http\Controllers\Controller as BaseController;

class CalendarEventController extends BaseController
{
    public function __construct()
    {
        $this->middleware(['web']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('chronos-events::events.client.index', ['events' => Event::orderBy('start_date_time', 'asc')->get()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);

        return view('chronos-events::events.client.show', ['event' => $event]);
    }
}
