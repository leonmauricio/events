<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mailer extends Model
{
    protected $table = 'mailer';

    protected $fillable = ['message'];
}
