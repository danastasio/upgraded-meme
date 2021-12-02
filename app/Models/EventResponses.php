<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Event;

class EventResponses extends Model {

    use HasFactory;
    protected $fillable = ['name', 'event_details_id', 'response', 'uuid'];

	public function eventDetails() {
		return $this->belongsTo(EventDetails::class);
	}

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
