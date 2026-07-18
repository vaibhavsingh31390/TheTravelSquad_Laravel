<div class="auth-page">
<div class="container-fluid p-0">
<div class="row g-0 min-vh-100" style="min-height: calc(100vh - 64px);">
<div class="col-lg-5 auth-panel-dark d-none d-lg-flex">
<div>
<div class="auth-accent-line"></div>
<h1>Travel<br>Squad</h1>
<p>Your stories. Your adventures. A minimal space for travelers who'd rather explore than scroll.</p>
</div>
</div>
<div class="col-lg-7">
<div class="form_Container h-100">
{{-- LOGIN FORM --}}
<form action="{{ route('login') }}" id="login_Form" method="post">
@csrf
<h2 class="heading mb-1">Sign In</h2>
<p class="text-muted mb-4" style="font-size: 0.9rem;">Enter your credentials to continue</p>
<div class="mb-3">
<label for="email" class="form-label">Email</label>
<input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" id="emailLogin" name="email" placeholder="you@example.com">
@if ($errors->has('email'))
<span class="invalid-feedback"><strong>{{ $errors->first() }}</strong></span>
@endif
</div>
<div class="mb-3">
<label for="exampleInputPassword1" class="form-label">Password</label>
<input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="passwordLogin" name="password" placeholder="••••••••">
@if ($errors->has('password'))
<span class="invalid-feedback"><strong>{{ $errors->first() }}</strong></span>
@endif
</div>
<div class="mb-4 form-check">
<input type="checkbox" class="form-check-input" id="rememberLogin" name="remember">
<label class="form-check-label" for="rememberLogin" style="font-size: 0.85rem;">Remember me</label>
</div>
<div class="mb-4">
<p class="mb-0" style="font-size: 0.85rem;">No account? <span class="click_EventPrimaryForm" id="register_Trigger">Register</span></p>
</div>
<button type="submit" class="btn btn-primary w-100">Sign In</button>
</form>

{{-- REGISTER FORM --}}
<form class="d-none" id="register_Form" action="{{ route('register') }}" method="post">
@csrf
<h2 class="heading mb-1">Register</h2>
<p class="text-muted mb-4" style="font-size: 0.9rem;">Join the squad and start sharing</p>
<div class="mb-3">
<label for="name" class="form-label">Name</label>
<input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="InputName" name="name" placeholder="Full name">
</div>
<div class="mb-3">
<label for="email" class="form-label">Email</label>
<input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="InputEmail1" name="email" placeholder="you@example.com">
</div>
<div class="mb-3">
<label for="password" class="form-label">Password</label>
<input type="password" class="form-control" id="Password1" name="password" placeholder="••••••••">
</div>
<div class="mb-3">
<label for="password_confirmation" class="form-label">Confirm Password</label>
<input type="password" class="form-control" id="Password2" name="password_confirmation" placeholder="••••••••">
</div>
<div class="mb-4">
<p class="mb-0" style="font-size: 0.85rem;">Have an account? <span class="click_EventPrimaryForm" id="login_Trigger">Sign In</span></p>
</div>
<button type="submit" class="btn btn-primary w-100">Create Account</button>
@if ($errors->has('password'))
<span class="invalid-feedback d-block mt-2"><strong id="Register-feedback">{{ $errors->all() }}</strong></span>
@endif
</form>
</div>
</div>
</div>
</div>
</div>

<script>
var loginForm = document.getElementById("login_Form");
var registerForm = document.getElementById("register_Form");
document.getElementById("register_Trigger").addEventListener("click", function() {
    loginForm.classList.add("d-none");
    registerForm.classList.remove("d-none");
});
document.getElementById("login_Trigger").addEventListener("click", function() {
    loginForm.classList.remove("d-none");
    registerForm.classList.add("d-none");
});
</script>
