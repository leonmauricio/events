<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
	protected $fillable = ['name', 'email','event_id','phone','address','city','country','identification','birth'];

	public function event()
    {
    	return $this->belongsTo(Event::class);
    }
}