<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EventResponses;

class Event extends Model {

	use HasFactory;

	protected $fillable = ['name','event_details'];

	public function details() {
		return $this->hasMany(EventDetails::class);
	}

	public function responses() {
		return $this->hasManyThrough(EventResponses::class, EventDetails::class, 'event_id', 'event_details_id');
	}
}
