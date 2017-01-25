@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Events</div>

                <div class="panel-body">
                    @if (!Auth::guest())
                        <a href="/events/create" class="btn btn-primary">
                            Create an event!
                        </a>
                        <hr>
                    @endif
                    Here are all the events!
                    <ul>
                        @foreach ($events as $event)
                            <div class="event-list">
                                <li>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="/events/{{ $event->id }}" class="pull-left">
                                                {{ $event->name }}
                                            </a>
                                        </div>
                                        <div class="col-md-6">
                                            @if (!Auth::guest())
                                                {{ Form::open(array('url' => 'events/' . $event->id, 'class' => 'pull-right')) }}
                                                    {{ Form::hidden('_method', 'DELETE') }}
                                                    {{ Form::submit('Delete Event', array('class' => 'btn btn-danger')) }}
                                                {{ Form::close() }}
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
