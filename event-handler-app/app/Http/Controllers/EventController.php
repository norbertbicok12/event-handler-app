<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index() {
        $events = Event::all(); // Retrieve all events
        return view('events', ['events' => $events]); // Pass events to the view
    }

    public function show($id) {
        $event = Event::findOrFail($id);
        return view('event', compact('event'));
    }

    public function search(Request $request) {
        $query = $request->input('query');
        $events = Event::where('title', 'like', "%$query%")
            ->orWhere('location', 'like', "%$query%")
            ->orWhere('place_of_event', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->get();
        return view('events', compact('events'));
    }

    public function showCreateForm() {
        return view('create');
    }

    public function showUserEvents() {
        if (Auth::check()) {
            $user = Auth::user();
            $myevents = Event::where('creator_user_id', $user->id)->get();
            return view('myevents', ['myevents' => $myevents]);
        } else {
            // Handle the case when the user is not authenticated
            return redirect()->route('login')->with('error', 'Please log in to view your events.');
        }
    }

    public function createEvent(Request $request) {
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
            $filename = time() . $file->getClientOriginalName();
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
}
