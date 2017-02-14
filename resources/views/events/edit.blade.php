@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Events</div>

                <div class="panel-body">
                    <form method="POST" action="/events/{{ $event->id }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label>Event name</label>
                            <input type="text" class="form-control" name="name" value="{{ $event->name }}">
                        </div>
                        <div class="form-group">
                            <label>Event Description</label>
                            <textarea class="form-control" name="desc">{{ $event->desc }}</textarea>
                        </div>

                        @if (!Auth::guest() && Auth::user()->isAdmin())
                            <div class="checkbox">
                                <label>
                                    <input name="featured" type="checkbox" value="1">Feature this event
                                </label>
                            </div>
                        @endif
                        
                        <div class="form-group">
                            <label>Capacity</label>
                            <input type="number" class="form-control" name="capacity" value="{{$event->capacity }}">
                        </div>

                        <div class="radio-inline">
                            <label><input type="radio" name="public" value="1">Public Event</label>
                        </div>
                        <div class="radio-inline">
                            <label><input type="radio" name="public" value="0">Private Event</label>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        From
                                    </label>
                                    <div class='input-group date datetimepicker'>
                                        <input type='text' name="start_date" class="form-control" value="{{ $event->start_date }}"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        until
                                    </label>
                                    <div class='input-group date datetimepicker'>
                                        <input type='text' name="end_date" class="form-control" value="{{ $event->end_date }}"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>
                                Optional Requirements
                            </label>
                            <div class="checkbox">
                                <label>
                                    <input @if (in_array('phone', $event->fields)) checked @endif name="fields[]" type="checkbox" value="phone">Phone Number
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input @if (in_array('address', $event->fields)) checked @endif name="fields[]" type="checkbox" value="address">Address
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input @if (in_array('city', $event->fields)) checked @endif name="fields[]" type="checkbox" value="city">City
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input @if (in_array('country', $event->fields)) checked @endif name="fields[]" type="checkbox" value="country">Country
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input @if (in_array('identification', $event->fields)) checked @endif name="fields[]" type="checkbox" value="identification">Identification Type and Number
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input @if (in_array('birth', $event->fields)) checked @endif name="fields[]" type="checkbox" value="birth">Birthday
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
