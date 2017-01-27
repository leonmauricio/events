@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>
                        {{ $event->name }}
                    </h2>
                    @if (!Auth::guest() && Auth::user()->id === $event->user_id)
                        <div class="delete pull-right">
                            {{ Form::open(array('url' => 'events/' . $event->id, 'class' => '')) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                {{ Form::submit('Delete Event', array('class' => 'btn btn-danger')) }}
                            {{ Form::close() }}
                        </div>
                    @endif
                    <h4>
                        by {{ $event->user->name }}
                    </h4>
                </div>

                <div class="panel-body">
                        <p>
                            {{ $event->desc }}
                        </p>
                        <p>
                            {{ $event->start_date }}-{{ $event->end_date }}
                        </p>
                </div>
                @if (Auth::guest() or Auth::user()->id !== $event->user_id)
                    <hr>
                    @if ($hasCapacity)
                        <div class="panel-heading">
                            <h2>
                                Go to this event!
                            </h2>
                            @if (session('alert'))
                                <div class="alert alert-danger">
                                    {{ session('alert') }}
                                </div>
                            @endif
                        </div>
                        <div class="panel-body">
                            <form method="POST" action="/guests">
                                {{ csrf_field() }}
                                <input type="hidden" name="event_id" value="{{ $event->id }}">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Email">
                                </div>
                                
                                    @if (in_array('phone', $event->fields))
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input type="tel" class="form-control" name="phone" placeholder="Phone Number">
                                        </div>
                                    @endif
                                    @if (in_array('address', $event->fields))
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control" name="address" placeholder="Address">
                                        </div>
                                    @endif
                                    @if (in_array('city', $event->fields))
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" class="form-control" name="city" placeholder="City">
                                        </div>
                                    @endif
                                    @if (in_array('country', $event->fields))
                                        <div class="form-group">
                                            <label>Country</label>
                                            <input type="text" class="form-control" name="country" placeholder="Country">
                                        </div>
                                    @endif
                                    @if (in_array('identification', $event->fields))
                                        <div class="form-group">
                                            <label>Identification Type and Number</label>
                                            <input type="text" class="form-control" name="identification" placeholder="Identification Type and Number">
                                        </div>
                                    @endif
                                    @if (in_array('birth', $event->fields))
                                        <div class="form-group">
                                            <label>Date of Birth</label>
                                            <div class='input-group date datetimepicker'>
                                                <input type='text' name="birth" class="form-control"/>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    @endif

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    @else
                        <h2 class="text-center">
                            No more room for this event!
                        </h2>
                    @endif
                @else
                    <ul>
                        @foreach ($event->guests as $guest)
                        <div class="guest-list">
                            <li>
                                <div class="row">
                                    <div class="col-md-10">
                                        {{ $guest->name }}
                                    </div>
                                    <div class="col-md-2">
                                        @if ($guest->assisted == 0)
                                            <form method="POST" action="/guests/{{ $guest->id }}">
                                                {{ csrf_field() }}
                                                {{ method_field('PATCH') }}
                                                    <button type="submit" class="btn btn-primary">Assisted</button>
                                            </form>
                                        @else(if ($guest->assisted))
                                            <div class="assisted">
                                                <span class="glyphicon glyphicon-check"></span> Assisted 
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        </div>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
