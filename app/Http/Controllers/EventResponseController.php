<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
            'event'             => Event::where('uuid', $request->uuid)->first(),
            'event_responses'   => Event::where('uuid', $request->uuid)->with("responses")->first(),
            'event_details'     => EventDetails::where('event_id', $request->id)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventResponseRequest $request) {
        $uuid = Str::uuid()->toString();
        foreach ($request->user_response as $user_response) {
			$response = new EventResponses($user_response);
			$response->uuid = $uuid;
			$response->save();
		}
		return view('response.create')->with([
            'event' => Event::where('id', $request->event_id)->with(['responses', 'details'])->first(),
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
