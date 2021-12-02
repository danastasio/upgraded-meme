<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventDetails extends Model
{
    protected $fillable = ['name', 'date', 'time', 'event_id'];

	public function event() {
		return $this->belongsTo(Event::class, 'event_id');
	}
}
