<!DOCTYPE html>
<html>
<body>

	<p>
		Remember that the event takes place from {{ $guest->event->start_date }} to {{ $guest->event->end_date }}
	</p>
	<hr>
	<a href="events.dev/unsubscribe/{{ $guest->invitation_id }}">Unsubscribe from this event</a>
</body>
</html>