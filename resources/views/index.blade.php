@extends('layouts.app')

@section('content')
<div class="jumbo">
    <div class="tint">
        <div class="container">
            <div class="row">
                <div class="title text-center">
                    <h1>
                        Beyond the ticket
                    </h1>
                    <p>
                        For custom event ticketing, admissions technology and on-site event operations support, <br>ShowClix is the trusted partner for thousands of event professionals. 
                    </p>
                    <a class="btn btn-primary">
                        LEARN MORE
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="search">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search">
                    <span class="input-group-btn">
                        <button class="btn" type="button">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
            </div>
            <div class="col-md-3">
                <p class="text-center search-login">
                    Already have tickets? <a href="/login">Log In</a>
                </p>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h5 class="text-center upcoming">
                Featured Events:
            </h5>
            @foreach ($events as $event)
                <div class="col-md-3">
                    <div class="card">
                        <div class="thumbnail" style="background-image: url('{{ $event->thumbnail }}')"></div>
                        <div class="card-block">
                            <h5>
                                {{ $event->start_date }} - {{ $event->end_date }}
                            </h5>
                            <h3 class="card-title">
                                <a href="/events/{{ $event->id }}">
                                    {{ $event->name }}
                                </a>
                            </h3>
                            <span>
                                {{ $event->fullAddress }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="last-call">
        <div class="row">
            <p class="text-center">
                LOOKING FOR EVENT TICKETING AND BOX OFFICE <br> SOLUTIONS? 
            </p>
        </div>
        <div class="row text-center">
            <a class="btn btn-success get-started">GET STARTED NOW</a>
            <a class="btn btn-primary get-started">TAKE THE TOUR</a>
        </div>
    </div>
</div>

@endsection
