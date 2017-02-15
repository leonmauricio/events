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
	    	$mail->guest_name = $guest->name;
	    	$mail->event_name = $event->name;
	    	$mail->save();
    	}

    	return redirect('/events');
    }

    public function send()
    {
    	$mails = Mailer::where('sent', 0)->take(2)->get();
    	
    	foreach ($mails as $mail) {
    		Mail::send('emails.update', ['mail' => $mail], function ($m) use ($mail) {
            	$m->from($_ENV['MAIL_USERNAME'], 'Laravel Events');
            	$m->to($mail->guest_mail, $mail->guest_name)->subject($mail->event_name . ' Update');
        	});
        	$mail->sent = 1;
        	$mail->save();
        	echo "Mail " . $mail->id . " Sent <br>";
    	}
    }
}