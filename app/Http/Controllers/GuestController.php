<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guest;
use Mail;

class GuestController extends Controller
{
    public function store(Request $request)
    {
        $guest = new Guest($request->all());

        if (count(Guest::where('email', $guest->email)->get())) {
            return back()->with('alert', 'E-Mail already registered');
        }

        $guest->invitation_id = md5($guest->email . $guest->event_id);
        $guest->save();

        $guest->load('event');
        Mail::send('emails.invited', ['guest' => $guest], function ($m) use ($guest) {
            $m->from('mauricio@nicolabs.com.ar', 'Laravel Events');

            $m->to($guest->email, $guest->name)->subject('You are now invited to the event ' . $guest->event->name . '!');
        });

        return redirect('/thanks');
    }

    public function update(Request $request, Guest $guest)
    {
        $guest->assisted = 1;
        $guest->update();
        return back();
    }
}
