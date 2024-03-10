@extends('layout')
@section('title', 'Event')
@section('content')

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="event-details">
                    @isset($event)
                        <img class="img-fluid mt-4" src="{{asset('uploads/' . $event->image)}}" alt="{{ $event->title }}">
                        <div class="col-md-8 d-flex justify-content-center align-items-center">
                            <div class="text-container">
                                <h1 class="mt-4">{{ $event->title }}</h1>
                                <h5 class="mt-4"><strong>Location:</strong> {{ $event->location }}, {{ $event->place_of_event }}</h5>
                                <h5 class="mt-4"><strong>Date:</strong> {{ $event->date_of_event }}</h5>
                                <p class="mt-4"><strong>Description:</strong> {{ $event->description }}</p>
                                <p class="mt-4"><strong>Participants:</strong> {{ $event->participants }}</p>
                                @auth
                                    @if($event->subscribed)
                                    <button class="btn btn-primary mb-4 mt-4" onclick="window.location.href='{{ route('unsubscribe', ['id' => $event->id]) }}'">Resign from participation</button>
                                    @else
                                        <button class="btn btn-primary mb-4 mt-4" onclick="window.location.href='{{ route('subscribe', ['id' => $event->id]) }}'">Participate</button>
                                    @endif
                                @else
                                    <button class="btn btn-primary mb-4 mt-4" onclick="window.location.href='{{ route('login') }}'">Participate</button>
                                @endauth
                            </div>
                        </div>
                    @else
                        <div class="alert alert-danger mt-5" role="alert">
                            Event not found.
                        </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>

@endsection
