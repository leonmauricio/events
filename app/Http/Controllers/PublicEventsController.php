<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class PublicEventsController extends Controller
{
    public function index()
    {
    	$events = Event::where('public', 1)->get();

    	foreach ($events as $event) {
            $event->guestQuantity = $event->guests->count();
            if ($event->guestQuantity < $event->capacity) {
                $event->soldOut = false;
            }
            else {
                $event->soldOut = true;
            }
        }
    	return view('public.index', compact('events'));
    }
}
