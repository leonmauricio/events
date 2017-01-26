<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use Auth;

class EventController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth')->except(['show']);
    }
    
    public function index()
    {
        if (!Auth::guest()){
            $events = Auth::user()->event;
            foreach ($events as $event) {
                $event->guestQuantity = $event->guests->count();
                if ($event->guestQuantity < $event->capacity) {
                    $event->soldOut = false;
                }
                else {
                    $event->soldOut = true;
                }
            }
        }
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

        if (strtotime($inputs['start_date']) > $inputs['end_date']){
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
        $event = Event::with('guests', 'user')->findOrFail($id);
        $event->load('user');

        $hasCapacity = $event->guests->count() < $event->capacity;
        return view('events.show', compact('event', 'hasCapacity'));
    }

    public function edit($id)
    {
        $event = Event::with('user')->find($id);
        if (Auth::user()->id !== $event->user_id){
            return redirect('/events');
        }
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::with('user')->find($id);
        if (Auth::user()->id !== $event->user_id){
            return redirect('/events');
        }
        $inputs = $request->all();
        $inputs['start_date'] .= ':00';
        $inputs['end_date'] .= ':00';

        if (strtotime($inputs['start_date']) > $inputs['end_date']){
            $event->update($inputs);
        } else {
            return back()->with('alert', 'End date has to be after the start date');
        }

        return view('events.show', ['event' => Event::findOrFail($id)]);
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect('/events');
    }
}