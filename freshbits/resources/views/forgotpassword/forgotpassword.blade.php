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
            <b>Change Password</b>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Change your password</p>

                <form action="{{url('forgotpass')}}" id="passform" method="post">
                    @csrf

                    <div class="mb-3">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                        <span style="color:red">@error('email'){{$message}}@enderror</span>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password">
                        <span style="color:red">@error('password'){{$message}}@enderror</span>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control"   placeholder="Confirm Password">
                        <span style="color:red">@error('confirm_password'){{$message}}@enderror</span>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Change password</button>

                    <br><br>
                    <a href="{{url('login')}}"><p>Back to login !</p></a>
                </form>
            </div>

        </div>
    </div>

</div>

<script>
    $(document).ready(function() {

        $("#passform").validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                new_password: {
                    required: true,
                    minlength: 8,
                },
                confirm_password: {
                    required: true,
                    minlength: 8,
                },
            },
            messages: {
                email: {
                    required: "The Email field is required",
                },
                new_password: {
                    required: "The New Password field is required",
                    minlength: "Please enter at least 8 characters.",
                },
                confirm_password: {
                    required: "The confirm password field is required",
                    minlength: "Please enter at least 8 characters.",
                },
            }
        });
    });
</script>
@endsection
