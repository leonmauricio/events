@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Public Events</div>

                <div class="panel-body">
                    Here are all the events!
                    <ul>
                        @foreach ($events as $event)
                            <div class="event-list">
                                <li>
                                    <div class="row">
                                        <div class="col-md-12">
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
                                    </div>
                                </li>
                            </div>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
