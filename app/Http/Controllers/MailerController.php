<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\User;
use App\Guest;
use App\Mailer;
use Mail;

class MailerController extends Controller
{
    public function index($id)
    {
    	$event = Event::findOrFail($id);
    	return view('emails.create', compact('event'));
    }

    public function store(Request $request, $id)
    {
    	$event = Event::with('user','guests')->find($id);

    	foreach ($event->guests as $guest) {
	    	$mail = new Mailer();
	    	$mail->message = $request->input('message');
	    	$mail->user_mail = $event->user->email;
	    	$mail->guest_mail = $guest->email;
	    	$mail->save();
    	}

    	/*
    	Mail::send('emails.update', ['guest' => $mail->guest_mail], function ($m) use ($guest) {
            $m->from('mauricio@nicolabs.com.ar', 'Laravel Events');
            $m->to($guest->email, $guest->name)->subject('You are now invited to the event ' . $event->name . '!');
        });
        */
    }
}
