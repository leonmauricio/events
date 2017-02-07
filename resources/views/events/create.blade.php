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
                        <div class="form-group">
                            <label>Event name</label>
                            <input type="text" class="form-control" name="name" placeholder="Event name">
                        </div>
                        <div class="form-group">
                            <label>Event Description</label>
                            <textarea class="form-control" name="desc" placeholder="Event name"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Capacity</label>
                            <input type="number" class="form-control" name="capacity" placeholder="Number of available invitations">
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
                                        <input type='text' name="start_date" class="form-control"/>
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
                                        <input type='text' name="end_date" class="form-control"/>
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
