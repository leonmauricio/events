<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guest;
use Mail;

class SubscribeController extends Controller
{
    public function update($invitation_id)
    {
    	$guest = Guest::where('invitation_id', $invitation_id)->first();
    	$updated = Guest::where('invitation_id', $invitation_id)->update(['unsubscribe' => 0 ]);

		Mail::send('emails.invited', ['guest' => $guest], function ($m) use ($guest) {
            $m->from('mauricio@nicolabs.com.ar', 'Laravel Events');
            $m->to($guest->email, $guest->name)->subject('You are now invited to the event ' . $guest->event->name . '!');
        });

    	return view('guests.index');
    }
}
