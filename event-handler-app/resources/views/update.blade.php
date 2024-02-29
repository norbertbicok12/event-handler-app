@extends('layout')
@section('title', 'Update Event')
@section('content')
    @extends('layout')
    @section('title', 'Update Event')
    @section('content')
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>Update Event</h2>
                    <form id="updateForm">
                        @csrf
                        <input type="hidden" name="id" value="{{ $event->id }}">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="Grand Chess Tournament: Battle of the Minds">
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location" value="Ady tér 10, Szeged">
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location" value="Ady tér 10, Szeged">
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location" value="Ady tér 10, Szeged">
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="text" class="form-control" id="date" name="date" value="2024-03-04 18:30">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    @endsection
    <script>
        $(document).ready(function () {
            $('#createForm').submit(function (e) {
                e.preventDefault();
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
