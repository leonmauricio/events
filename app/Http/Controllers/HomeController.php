<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Event;

class HomeController extends Controller
{
    public function index()
    {
        $events = Event::where('featured', 1)->get();
        foreach ($events as $event) {
            $event->guestQuantity = $event->guests->count();
            if ($event->guestQuantity < $event->capacity) {
                $event->soldOut = false;
            }
            else {
                $event->soldOut = true;
            }
        }

        return view('index', compact('events'));
    }
}
