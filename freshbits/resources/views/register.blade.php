@extends('layout')
@section('content')

<style>
    .error {
        color: red;
    }

    .form-control.error {
        border-color: red;
    }
</style>

<div class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <b>Register Form</b>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Register in Our Application</p>

                <form action="{{url('register')}}" id="registerform" method="post">
                    @csrf

                    <div class="mb-3">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                        <span style="color:red">@error('name'){{$message}}@enderror</span>
                    </div>
                    <div class="mb-3">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                        <span style="color:red">@error('email'){{$message}}@enderror</span>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                        <span style="color:red">@error('password'){{$message}}@enderror</span>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                </form>

                <br>
                <p>Already have an account? <a href="{{url('login')}}">Login here</a></p>
            </div>

        </div>
    </div>

</div>

<script>
    $(document).ready(function() {

        $("#registerform").validate({
            rules: {
                name: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 8,
                },
            },
            messages: {
                name: {
                    required: "The Name field is required",
                },
                email: {
                    required: "The Email field is required",
                },
                password: {
                    required: "The Password field is required",
                    minlength: "Please enter at least 8 characters.",
                }
            }
        });

    });
</script>
@endsection
