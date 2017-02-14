@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Events</div>

                <div class="panel-body">
                    <form method="POST" action="/events" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <div class="form-group">
                            <label>Event name</label>
                            <input type="text" class="form-control" name="name" placeholder="Event name" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label>Event Description</label>
                            <textarea class="form-control" name="desc" placeholder="Event name">{{ old('desc') }}</textarea>
                        </div>
                        @if (Auth::user()->admin)
                            <div class="checkbox">
                                <label>
                                    <input name="featured" type="checkbox" value="1">Feature this event
                                </label>
                            </div>
                        @endif

                        <div class="form-group">
                            <label>Capacity</label>
                            <input type="number" class="form-control" name="capacity" placeholder="Number of available invitations" value="{{ old('capacity') }}">
                        </div>

                        <div class="radio-inline">
                            <label><input type="radio" name="public" value="1">Public Event</label>
                        </div>
                        <div class="radio-inline">
                            <label><input type="radio" name="public" value="0">Private Event</label>
                        </div>
                        <div class="form-group">
                            <label>Event Cover</label>
                            <input type="file" class="form-control" name="cover">
                        </div>

                        @if (session('alert'))
                            <div class="alert alert-danger">
                                {{ session('alert') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        From
                                    </label>
                                    <div class='input-group date datetimepicker'>
                                        <input type='text' name="start_date" class="form-control" value="{{ old('start_date') }}">
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
                                        <input type='text' name="end_date" class="form-control" value="{{ old('end_date') }}">
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
                                    <input name="fields[]" type="checkbox" value="phone">Phone Number
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="fields[]" type="checkbox" value="address">Address
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="fields[]" type="checkbox" value="city">City
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="fields[]" type="checkbox" value="country">Country
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="fields[]" type="checkbox" value="identification">Identification Type and Number
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="fields[]" type="checkbox" value="birth">Birthday
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
