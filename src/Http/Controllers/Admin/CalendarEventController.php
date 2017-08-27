<?php

namespace Weerd\ChronosEvents\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Weerd\ChronosEvents\Models\ChronosEvent as Event;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Weerd\ChronosEvents\Http\Controllers\Controller as BaseController;

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
        return view('chronos-events::events.admin.index', ['events' => Event::orderBy('start_date_time', 'asc')->get()]);
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
            'start_date' => 'required|date',
            'start_timezone' => 'required|timezone',
            'end_date' => 'required|date',
            'end_timezone' => 'required|timezone',
        ]);

        $event = Event::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'start_date_time' => utc_date_time($request->input('start_date'), $request->input('start_time'), $request->input('start_timezone')),
            'start_timezone' => $request->input('start_timezone'),
            'end_date_time' => utc_date_time($request->input('end_date'), $request->input('end_time'), $request->input('end_timezone')),
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
        $this->validate($request, [
            'title' => 'required',
            'start_date' => 'required|date',
            'start_timezone' => 'required|timezone',
            'end_date' => 'required|date',
            'end_timezone' => 'required|timezone',
        ]);

        $event = Event::find($id);

        $request['start_date_time'] = utc_date_time($request->input('start_date'), $request->input('start_time'), $request->input('start_timezone'));
        $request['end_date_time'] = utc_date_time($request->input('end_date'), $request->input('end_time'), $request->input('end_timezone'));

        // @TODO: does all_day get set properly?
        $event->fill($request->except([
            'start_date',
            'start_time',
            'end_date',
            'end_time'
        ]))->save();

        return redirect()->route('admin.events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id)->destroy($id);

        return redirect()->route('admin.events.index');
    }
}
