<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
	protected $fillable = ['name', 'email','event_id'];

	public function event()
    {
    	return $this->belongsTo(Event::class);
    }
}