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

        if (Auth::user()->admin){
            $events = Event::with('guests', 'user')->get();
        }
        else if (!Auth::guest()){
            $events = Auth::user()->event;
        }

        foreach ($events as $event) {
            $event->guestQuantity = $event->guests->count();
            if ($event->guestQuantity < $event->capacity) {
                $event->soldOut = false;
            }
            else {
                $event->soldOut = true;
            }
        }

        return view('events.index', compact('events'));
    }

    public function create()
    {
        $json = file_get_contents('http://country.io/names.json');
        $country_list = json_decode($json, TRUE);
        asort($country_list);

        return view('events.create', compact('country_list'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'cover' => 'required|dimensions:min_width=1600,height=340|between:0,1024|image',
            'name' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date'
        ]);

        $inputs = $request->all();

        $inputs['start_date'] .= ':00';
        $inputs['end_date'] .= ':00';

        $url = $request->cover->store('public');
        $url = str_replace('public','storage',$url);

        $event = new Event($inputs);
        $event->cover = $url;
        $event->user_id = Auth::id();
        $event->save();

        return redirect('/events');
    }

    public function show($id)
    {
        $event = Event::with('guests', 'user')->findOrFail($id);
        $event->load('user');

        $hasCapacity = $event->guests->count() < $event->capacity;
        $address = $event->address . ', ' . $event->city . ', ' . $event->country;
        return view('events.show', compact('event', 'hasCapacity','address'));
    }

    public function edit($id)
    {
        $event = Event::with('user')->find($id);
        if (Auth::user()->id !== $event->user_id && !Auth::user()->admin){
            return redirect('/events');
        }

        $json = file_get_contents('http://country.io/names.json');
        $country_list = json_decode($json, TRUE);
        asort($country_list);

        return view('events.edit', compact('event','country_list'));
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