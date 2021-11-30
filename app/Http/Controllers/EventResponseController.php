<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventDetails;
use App\Models\EventResponses;
use App\Http\Requests\EventRequest;
use App\Http\Requests\EventResponseRequest;

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
    public function create(EventResponseRequest $request) {
        return view('response.create')->with([
            'event'             => Event::find($request->id),
            'event_responses'   => Event::find($request->id)->with("responses")->get(),
            'event_details'     => EventDetails::where('event_id', $request->id)->get(),
        ]);
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
		return view('response.create')->with([
            'event'             => Event::find($request->event_id),
            'event_responses'   => EventResponses::where('event_id', $request->event_id)->get(),
            'event_details'     => EventDetails::where('event_id', $request->event_id)->get(),
        ]);

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
