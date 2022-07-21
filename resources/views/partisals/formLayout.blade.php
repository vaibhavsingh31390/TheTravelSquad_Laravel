<div class="container">
<div class="row">
<div class="col-md-12 col-sm-12 col-lg-6 form_Container">
{{-- LOGIN FORM --}}
<form class="mx-auto" action="{{ route('login') }}" id="login_Form" method="post">
@csrf
<h2 class="heading mt-4 mb-3 text-left">Login To Your Account.</h2>
<div class="mb-3">
<label for="email" class="form-label">Email address</label>
<input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" id="emailLogin" name="email">
@if ($errors->has('email'))
<span class="invalid-feedback">
<strong>
{{ $errors->first() }}
</strong>
</span>
@endif
</div>
<div class="mb-3">
<label for="exampleInputPassword1" class="form-label">Password</label>
<input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="passwordLogin" name="password">
@if ($errors->has('password'))
<span class="invalid-feedback">
<strong>
{{ $errors->first() }}
</strong>
</span>
@endif
</div>
<div class="mb-3 form-check">
<input type="checkbox" class="form-check-input" id="rememberLogin" name="remember">
<label class="form-check-label" for="exampleCheck1">Remember Me.</label>
</div>

<div class="text-left mb-2">
<p>Not a member? &nbsp; <span class="click_EventPrimaryForm" id="register_Trigger">Register</span></p>
</div>
<button type="submit" class="btn btn-primary w-25">Login</button>
</form>
{{-- REGISTERATION FORM --}}
<form class="mx-auto d-none" id="register_Form" action="{{ route('register') }}" method="post">
@csrf
<h2 class="heading mt-4 mb-3 text-left">Register New Account.</h2>
<div class="mb-3">
<label for="name" class="form-label">Name</label>
<input type="text" class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}" id="InputName" name="name">
</div>
<div class="mb-3">
<label for="email" class="form-label">Email address</label>
<input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="InputEmail1" name="email">
</div>
<div class="mb-3">
<label for="password" class="form-label">Password</label>
<input type="password" class="form-control" id="Password1" name="password">
</div>
<div class="mb-3">
<label for="password_confirmation" class="form-label">Confirm Password</label>
<input type="password" class="form-control" id="Password2" name="password_confirmation">
</div>
<div class="text-left mb-2">
<p>Already a member? &nbsp; <span class="click_EventPrimaryForm" id="login_Trigger">Login</span></p>
</div>
<button type="submit" class="btn btn-primary w-25">Register</button>
@if ($errors->has('password'))
<span class="invalid-feedback">
<strong id="Register-feedback">
{{ $errors->all() . "<br>" }}
</strong>
</span>
@endif
</form>
</div>
<div class="col-md-3 col-sm-12 col-lg-6 d-flex justify-content-center align-items-center imageSvgLogin">
<img src="{{ asset('assets/loginSVG.svg') }}" alt="undraw-Authentication-re-svpt" width="79%">
</div>
</div>
</div>

@section('script')
<script>
    var loginForm = document.getElementById("login_Form");
    var registerForm = document.getElementById("register_Form");
    document
        .getElementById("register_Trigger")
        .addEventListener("click", function() {
        loginForm.classList.add("d-none");
        registerForm.classList.remove("d-none");
        });
        document.getElementById("login_Trigger").addEventListener("click", function() {
        loginForm.classList.remove("d-none");
        registerForm.classList.add("d-none");
    });
</script>
@endsection