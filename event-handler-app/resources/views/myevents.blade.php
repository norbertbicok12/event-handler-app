@extends('layout')
@section('title', 'My Events')
@section('content')
    <div class="container">
        <div class="row">
            @foreach ($myevents as $event)
                <div class="col-md-4 mb-4 mt-5">
                    <div class="card clickable" onclick="window.location.href='{{ route('events.show', ['id' => $event->id]) }}'">
                        <div class="card-body">
                            <img class="card-img" src="{{ asset('uploads/' . $event->image) }}" alt="{{ $event->title }}">
                            <p class="card-title mt-3">{{ $event->title }}</p>
                            <p class="card-text mt-3">Location: {{ $event->location }}, {{ $event->place_of_event }}</p>
                            <p class="card-text">Date: {{ $event->date_of_event }}</p>
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="confirmDelete()" class="btn btn-danger">Delete</button>
                                <a href="{{ route('update.event', $event->id) }}" class="btn btn-primary">Update</a>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        function confirmDelete() {
            if (confirm("Are you sure you want to delete this event?")) {
                document.getElementById('deleteForm').submit();
            }
        }
    </script>

@endsection
