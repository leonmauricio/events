<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use Auth;

class EventController extends Controller
{
    protected $get_country = '';

    public function __construct()
    {
         $this->middleware('auth')->except(['show']);
    }
    
    public function index()
    {

        if (Auth::user()->admin){
            $events = Event::with('guests', 'user')->get();
        } else if (!Auth::guest()){
            $events = Auth::user()->event;
        }

        foreach ($events as $event) {
            $event->guestQuantity = $event->guests->count();
            if ($event->guestQuantity < $event->capacity) {
                $event->soldOut = false;
            } else {
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

        $find_ip = file_get_contents('https://ipinfo.io');
        $ip_country = json_decode($find_ip, TRUE);
        $ip_country = $ip_country['country'];

        return view('events.create', compact('country_list','ip_country'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'cover' => 'required|dimensions:min_width=1600,height=340|between:0,1024|image',
            'thumbnail' => 'required|dimensions:width=480,height=480|between:0,1024|image',
            'name' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date'
        ]);

        $inputs = $request->all();

        $inputs['start_date'] .= ':00';
        $inputs['end_date'] .= ':00';

        $cover_url = $request->cover->store('public');
        $cover_url = str_replace('public','storage',$cover_url);

        $thumb_url = $request->thumbnail->store('public');
        $thumb_url = str_replace('public','storage',$thumb_url);

        $event = new Event($inputs);
        $event->cover = $cover_url;
        $event->thumbnail = $thumb_url;
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

        $this->validate($request, [
            'name' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date'
        ]);

        $event = Event::with('user')->find($id);
        if (Auth::user()->id !== $event->user_id){
            return redirect('/events');
        }
        $inputs = $request->all();
        $inputs['start_date'] .= ':00';
        $inputs['end_date'] .= ':00';

        return view('events.show', ['event' => Event::findOrFail($id)]);

        return view('events.show', ['event' => Event::findOrFail($id)]);
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect('/events');
    }
}