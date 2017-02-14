@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-body">
                    <h3>Featured Events</h3>

                    <ul>
                        @foreach ($events as $event)
                            <div class="event-list">
                                <li>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="/events/{{ $event->id }}" class="pull-left">
                                                {{ $event->name }}
                                            </a>
                                            @if ($event->soldOut)
                                                <p class="pull-right">
                                                    SOLD OUT
                                                </p>
                                            @else
                                                <p class="pull-right">
                                                    {{ $event->guestQuantity }} / {{ $event->capacity }} invitations left
                                                </p>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            @if (!Auth::guest() && Auth::user()->id === $event->user_id || !Auth::guest() && Auth::user()->admin === 1)
                                                <a  href="/events/{{ $event->id }}/edit" class="btn btn-warning pull-right">
                                                    Edit Event
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            </div>
                        @endforeach
                    </ul>

                    <a href="/public/events">See all the Events</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
