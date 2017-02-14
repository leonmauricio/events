<!DOCTYPE html>
<html>
<body>

	<p>
		{{ $mail->message }}
	</p>
	<hr>
	<a href="events.dev/unsubscribe/{{ $event->guest->invitation_id }}">Unsubscribe from this event</a>
</body>
</html>