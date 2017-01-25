<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use Auth;


class EventController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth')->except(['index','show']);
    }
    
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    public function create()
    {

        return view('events.create');
    }

    public function store(Request $request)
    {
        $inputs = $request->all();
        $inputs['start_date'] .= ':00';
        $inputs['end_date'] .= ':00';

        if (strtotime($inputs['start_date']) < $inputs['end_date']){
            $event = new Event($inputs);
            $event->user_id = Auth::id();

            $event->save();

            return redirect('/events');
        }
        else{
            return back()->with('alert', 'End date has to be after the start date');
        }
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        $event->load('user');
        return view('events.show', compact('event'));
    }

    public function edit($id)
    {
        return view('events.edit', ['event' => Event::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $inputs = $request->all();
        $inputs['start_date'] .= ':00';
        $inputs['end_date'] .= ':00';
        $event->update($inputs);
        return view('events.show', ['event' => Event::findOrFail($id)]);
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect('/events');
    }
}