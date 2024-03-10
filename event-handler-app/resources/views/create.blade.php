@extends('layout')
@section('title', 'Create Event')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="mt-5">
                    <div id="errorAlertContainer"></div>
                </div>
                <form id="createForm">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" id="location" name="location">
                    </div>
                    <div class="mb-3">
                        <label for="place_of_event" class="form-label">Place of Event (City)</label>
                        <input type="text" class="form-control" id="place_of_event" name="place_of_event">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control col-md-12" id="description" name="description" rows="5"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="datetime" class="form-label">Date</label>
                        <input type="datetime-local" class="form-control" id="datetime" name="datetime">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image Upload</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="limitCity" name="limitCity">
                            <label class="form-check-label" for="limitCity">Limit to this city</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3 mb-5">Create</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#createForm').submit(function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: '/create',
                    type: 'POST',
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function (response) {
                        window.location.href = '/my_events';
                    },
                    error: function (xhr) {
                        var errors = xhr.responseJSON.errors;
                        var errorMessage = '';
                        $.each(errors, function (key, value) {
                            errorMessage += value[0] + '<br>';
                        });
                        var alertHTML = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                            errorMessage +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                            '</div>';

                        // Append the alert to the container
                        $('#errorAlertContainer').html(alertHTML);
                    }
                });
            });
        });
    </script>
@endsection
