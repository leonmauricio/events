@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Events</div>

                <div class="panel-body">
                    <form method="POST" action="/events/{{ $event->id }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

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
                            <label><input type="radio" name="public" value="1" @if ($event->public == 1) checked="checked" @endif>Public Event</label>
                        </div>
                        <div class="radio-inline">
                            <label><input type="radio" name="public" value="0" @if ($event->public == 0) checked="checked" @endif>Private Event</label>
                        </div>

                        <div class="form-group">
                            <div class="cover-edit" style="background-image: url(/{{$event->cover}})"></div>
                            <label>Event Cover</label>
                            <input type="file" class="form-control" name="cover">
                            <span class="restriction">1600 x 340 pixels</span>
                        </div>

                        <div class="form-group">
                            <div class="cover-edit" style="background-image: url(/{{$event->thumbnail}})"></div>
                            <label>Event Thumbnail</label>
                            <input type="file" class="form-control" name="thumbnail">
                            <span class="restriction">480 x 480 pixels</span>
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" name="address" placeholder="Address" value="{{ $event->address }}">
                        </div>
                        
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class="form-control" name="city" placeholder="City" value="{{ $event->city }}">
                        </div>

                        <div class="form-group">
                            <label>Country</label>
                            <select name="country" class="form-control">
                                @foreach ($country_list as $code => $country)
                                    <option value="{{ $code }}" @if ($code == $event->country) selected="selected" @endif >{{ $country }}</option>
                                @endforeach
                            </select>
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
                                    <input @if (isset($event->fields) && in_array('phone', $event->fields)) checked @endif name="fields[]" type="checkbox" value="phone">Phone Number
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input @if (isset($event->fields) && in_array('address', $event->fields)) checked @endif name="fields[]" type="checkbox" value="address">Address
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input @if (isset($event->fields) && in_array('city', $event->fields)) checked @endif name="fields[]" type="checkbox" value="city">City
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input @if (isset($event->fields) && in_array('country', $event->fields)) checked @endif name="fields[]" type="checkbox" value="country">Country
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input @if (isset($event->fields) && in_array('identification', $event->fields)) checked @endif name="fields[]" type="checkbox" value="identification">Identification Type and Number
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input @if (isset($event->fields) && in_array('birth', $event->fields)) checked @endif name="fields[]" type="checkbox" value="birth">Birthday
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
