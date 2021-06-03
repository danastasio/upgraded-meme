<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\EventDetails;

class EventController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
		$request = request();
        return view('event.create')->with('event_name', $request->event_name);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request) {
		$event = new Event;
		$event->name = $request->event_name;
		$event->description = $request->description;
		$event->save();

		$event_id = $event->id;

		$eventDetails = new EventDetails;

		for ($i=0; $i<count($request->date);$i++) {
			$details = new EventDetails;
			$details->event_id = $event_id;
			$details->date = $request->date[$i];
			$details->time = $request->time[$i];
			$details->save();
		}

		return redirect()->action([EventResponseController::class, 'create'], ['id' => $event_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
}
