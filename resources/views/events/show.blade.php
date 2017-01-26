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
                <hr>
                @if (Auth::guest())
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
                                    <input type="email" class="form-control" name="email" placeholder="Email"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    @else
                        <h2>
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
                                        @elseif ($guest->assisted == 1)
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
