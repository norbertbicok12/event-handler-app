@extends('layout')
@section('title', 'Events')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('events.search') }}" method="GET" class="input-group">
                    <label>
                        <input type="text" name="query" class="form-control" placeholder="Search events...">
                    </label>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
        <div class="row">
            @foreach ($events as $event)
                <div class="col-md-4 mb-4 mt-5">
                    <div class="card clickable" onclick="window.location.href='{{ route('events.show', ['id' => $event->id]) }}'">
                        <div class="card-body">
                            <img class="card-img" src="{{asset('uploads/' . $event->image)}}" alt="{{ $event->title }}">
                            <p class="card-title mt-3">{{ $event->title }}</p>
                            <p class="card-text mt-3">Location: {{ $event->location }}, {{ $event->place_of_event }}</p>
                            <p class="card-text">Date: {{ $event->date_of_event }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

@endsection
