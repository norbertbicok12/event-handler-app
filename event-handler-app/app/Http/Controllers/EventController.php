<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Participation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            $user = Auth::user();
            $events = Event::where('user_visibility', "All")
                    ->orWhere('user_visibility', $user->place_of_birth)->get();

        } else {
            $events = Event::where('user_visibility', "All")->get();
        }
        return view('events', compact('events')); // Pass events to the view
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        $event['subscribed'] = false;
        if(Auth::check()){
            $user = Auth::user();
            if(Participation::where('event_id', $event->id)->where('user_id', $user->id)->exists()){
                $event['subscribed'] = true;
            }
        }
        $event['participants'] = Participation::where('event_id', $event->id)->count() ?? 0;

        return view('event', compact('event'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $events = Event::where('title', 'like', "%$query%")
            ->orWhere('location', 'like', "%$query%")
            ->orWhere('place_of_event', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->get();
        return view('events', compact('events'));
    }

    public function showCreateForm()
    {
        return view('create');
    }

    public function showUserEvents()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $myevents = Event::where('creator_user_id', $user->id)->get();
            return view('myevents', ['myevents' => $myevents]);
        } else {
            return redirect()->route('login')->with('error', 'Please log in to view your events.');
        }
    }

    public function createEvent(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'location' => 'required',
            'place_of_event' => 'required',
            'datetime' => 'required',
            'description' => 'required'
        ]);
        $filename = 'default_image.jpg';
        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move('uploads', $filename);
        }

        $limitCity = 'All';
        if($request->has('limitCity')){
            $limitCity = $request->place_of_event;
        }

        $user = Auth::user();
        $datetime = Carbon::parse($request->datetime);

        $data['title'] = $request->title;
        $data['location'] = $request->location;
        $data['place_of_event'] = $request->place_of_event;
        $data['image'] = $filename;
        $data['description'] = $request->description;
        $data['date_of_event'] = $datetime;
        $data['user_visibility'] = $limitCity;
        $data['creator_user_id'] = $user->id;

        $event = Event::create($data);
        if(!$event){
            return response()->json(['error' => 'User does not exist'], 422);
        }
        return response()->json(['success' => true], 200);

    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('my.events');
    }

    public function updateEvent($id)
    {
        $event = Event::findOrFail($id);
        return view('update', compact('event'));
    }

    public function updateEventPost(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'title' => 'required',
            'location' => 'required',
            'place_of_event' => 'required',
            'description' => 'required',
            'datetime' => 'required'
        ]);

        $id = $request->id;
        $data['title'] = $request->title;
        $data['location'] = $request->location;
        $data['place_of_event'] = $request->place_of_event;
        $data['description'] = $request->description;
        $data['date_of_event'] = $request->datetime;

        $data['datetime'] = date('Y-m-d H:i:s', strtotime($request->datetime));

        Event::where('id', $id)->update($data);

        return response()->json(['success' => true, 'message' => 'Event updated successfully'], 200);
    }

    public function subscribe($id)
    {
        $user = Auth::user();
        $data['event_id'] = $id;
        $data['user_id'] = $user->id;

        Participation::create($data);

        return back();
    }

    public function unsubscribe($id)
    {
        $user = Auth::user();

        $participation = Participation::where('event_id', $id)->where('user_id', $user->id)->first();

        if ($participation) {
            $participation->delete();
        }

        return back();
    }

    public function showUserParticipations()
    {

        if (Auth::check()) {
            $user = Auth::user();

            $participatedEventIds = Participation::where('user_id', $user->id)->pluck('event_id')->toArray();

            $participatedEvents = Event::whereIn('id', $participatedEventIds)->get();

            return view('participate', ['myevents' => $participatedEvents]);
        } else {
            return redirect()->route('login')->with('error', 'Please log in to view your events.');
        }
    }
}
