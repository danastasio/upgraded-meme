<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventDetails extends Model
{
	protected $fillable = ['name', 'date', 'time', 'event_id'];

	public static function create(array $attributes, Event $event): EventDetails
	{
	    $details = new EventDetails;
		$details->fill($attributes);
		$details->event()->associate($event);
		$details->save();
		return $details;
	}

	public function event() {
		return $this->belongsTo(Event::class, 'event_id');
	}
}
