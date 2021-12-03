<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Event;

class EventResponses extends Model {

	use HasFactory;
	protected $fillable = ['name', 'event_details_id', 'response', 'uuid'];

	public static function create(array $attributes, string $respondant_name, string $uuid): EventResponses
	{
		$response = new EventResponses;
		$response->fill($attributes);
		$response->name = $respondant_name;
		$response->uuid = $uuid;
		$response->save();
		return $response;
	}

	public function eventDetails() {
		return $this->belongsTo(EventDetails::class);
	}

	public function event()
	{
		return $this->belongsTo(Event::class);
	}
}
