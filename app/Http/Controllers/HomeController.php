<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Event;
use DateTime;

class HomeController extends Controller
{
    public function index()
    {
        $events = Event::where('featured', 1)->get();
        foreach ($events as $event) {
            $event->guestQuantity = $event->guests->count();
            $event->fullAddress = $event->city . ', ' . $event->country;
            $event->fullDate = strftime('%A %d %B, %R', strtotime($event->start_date));

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
