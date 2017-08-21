<?php

namespace Weerd\ChronosEvents\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Weerd\ChronosEvents\Http\Controllers\Controller as BaseController;
use Weerd\ChronosEvents\Models\ChronosEvent as Event;

class CalendarEventController extends BaseController
{
    public function __construct()
    {
        $this->middleware(['web', 'auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('chronos-events::events.admin.index', ['events' => Event::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('chronos-events::events.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            // @TODO: add other validation items
        ]);

        // @TODO: move to model as attribute accessors
        $startDateTime = null;
        $endDateTime = null;
        // https://www.wikiwand.com/en/List_of_tz_database_time_zones
        if ($request->input('start_date')) {
            $startDateTime = Carbon::parse($request->input('start_date') . ' ' . $request->input('start_time'), $request->input('start_timezone'))->timezone('utc');
        }

        if ($request->input('end_date')) {
            $endDateTime = Carbon::parse($request->input('end_date') . ' ' . $request->input('end_time'), $request->input('end_timezone'))->timezone('utc');
        }

        $request = Event::parseDateTimes($request);

        $event = Event::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'start_date_time' => $startDateTime,
            'start_timezone' => $request->input('start_timezone'),
            'end_date_time' => $endDateTime,
            'end_timezone' => $request->input('end_timezone'),
            'all_day' => $request->input('all_day') ?: false,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.events.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('chronos-events::events.admin.edit', ['event' => Event::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $event = Event::find($id);

        $event->fill($request->all())->save();

        return redirect()->route('admin.events.index');
    }
}
