<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['name', 'desc','capacity','fields','public','start_date','end_date'];

    protected $casts = ['fields'=>'array'];

    public function user()
    {
        return $this->belongsTo(User::class); 
    }

    public function guests()
    {
        return $this->hasMany(Guest::class);
    }
}
