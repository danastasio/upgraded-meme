<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventResponses extends Model {

    use HasFactory;

	public function eventDetails() {
		return $this->belongsTo(EventDetails::class);
	}
}
