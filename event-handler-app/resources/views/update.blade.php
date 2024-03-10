@extends('layout')
@section('title', 'Update Event')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div id="errorAlertContainer"></div>
                <h2>Update Event</h2>
                <form id="updateForm">
                    @csrf
                    <input type="hidden" name="id" value="{{ $event->id }}">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{$event->title}}">
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" id="location" name="location" value="{{$event->location}}">
                    </div>
                    <div class="mb-3">
                        <label for="place_of_event" class="form-label">Location</label>
                        <input type="text" class="form-control" id="place_of_event" name="place_of_event" value="{{$event->place_of_event}}">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control col-md-12" id="description" name="description" rows="5">{{$event->description}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="datetime" class="form-label">Date</label>
                        <input type="datetime-local" class="form-control" id="datetime" name="datetime" value="{{$event->date_of_event}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('my.events') }}" class="btn btn-primary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#updateForm').submit(function (e) {
                e.preventDefault();
                if (confirm("Are you sure you want to update this event?")) {
                    var formData = $(this).serialize();
                    $.ajax({
                        url: '/update',
                        type: 'POST',
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: formData,
                        success: function (response) {
                            window.location.href = '/my_events';
                        },
                        error: function (xhr) {
                            var errorMessage = 'An error occurred while processing your request.';

                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                var errors = xhr.responseJSON.errors;
                                errorMessage = '';
                                $.each(errors, function (key, value) {
                                    errorMessage += value[0] + '<br>';
                                });
                            }

                            var alertHTML = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                                errorMessage +
                                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                                '</div>';

                            // Append the alert to the container
                            $('#errorAlertContainer').html(alertHTML);
                        }
                    });
                }
            });
        });
    </script>
@endsection
