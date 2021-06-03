<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventDetails;
use App\Models\EventResponses;
use App\Http\Requests\EventRequest;

class EventResponseController extends Controller {
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
		$event_details = EventDetails::where('event_id', request()->id)->orderBy('date')->get();
		if (count($event_details) === 0) {
			return redirect('/')->withWarning('Event does not exist. You can create it below!');
		}
		$event_responses = Event::where('id', request()->id)->with('responses')->get();
        return view('response.create')->with('event_responses', $event_responses)->with('event_details', $event_details);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request) {
		$request_uuid = exec('uuidgen -r');
        for ($i=0;$i<count($request->event_ids);$i++) {
			$response = new EventResponses;
			$response->name = $request->name;
			$response->event_details_id = $request->event_ids[$i];
			$var = "radio".$i;
			$response->response = $request->$var;
			$response->uuid = $request_uuid;
			$response->save();
		}
		$event_details = EventDetails::where('event_id', request()->event_id)->orderBy('date')->get();
		$event_responses = Event::where('id', request()->event_id)->with('responses')->get();
        return view('response.create')->with('event_responses', $event_responses)->with('event_details', $event_details);
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
