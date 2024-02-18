@extends('layouts.auth')
@section('content')
<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Register</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
                        <form action="{{ route('sign_up') }}" method="post" class="signin-form">
                            @if(Session::has('success'))
                                <div class="alert alert-success">{{ Session::get('success') }}</div>
                            @endif
                            @if(Session::has('fail'))
                                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                            @endif
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Name" id="name" value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email" id="email"  value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password" id="password" value="{{ old('password') }}">
                                <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" id="confirm-password"  value="{{ old('confirm_password') }}">
                                <span toggle="#confirm-password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3" id="sign-up-btn">Sign Up</button>
                            </div>
                        </form>
                        <h5 class="mb-4 text-center"><a href="{{ route('login') }}" style="color: #fbceb5">Login Now!</a></h5>
		            </div>
				</div>
			</div>
		</div>
</section>
@endsection
@section('scripts')
    <script>
        // $('.is-input').keyup(function() {
        //     if(checkInput()) {
        //         $('#but-login').prop('disabled', false);
        //     } else {
        //         $('#but-login').prop('disabled', true);
        //     }
        // });
        // function checkInput()
        // {
        //     if (isEmpty($('#floatingInput').val()) || isEmpty($('#floatingPassword').val())) {
        //         return false;
        //     }
        //     return true;
        // }
    </script>
@endsection