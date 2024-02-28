@extends('layout')
@section('title', 'Register')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="mt-5">
                    <div id="errorAlertContainer"></div>
                </div>
                <form id="registerForm">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="place_of_birth" class="form-label">Place of Birth</label>
                        <input type="text" class="form-control" id="place_of_birth" name="place_of_birth">
                    </div>
                    <button type="submit" class="btn btn-primary"
                            style="background-color: #071013; border-color: #071013">Register
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#registerForm').submit(function (e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: '/register',
                    type: 'POST',
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    success: function (response) {
                        console.log("Szia");
                        window.location.href = '/login';
                    },
                    error: function (xhr) {
                        console.log("asd");
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
