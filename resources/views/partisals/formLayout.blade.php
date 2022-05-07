<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12 form_Container">
            {{-- LOGIN FORM --}}
            <form class="mx-auto w-100" id="login_Form" action="{{ route('login') }}" method="post">
                @csrf
                <h2 class="heading mt-4 mb-3 text-left">Login To Your Account.</h2>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control  {{ $errors->has('email') ? 'is-invalid' : '' }}" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
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
                    <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="exampleInputPassword1" name="password">
                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                        <strong>
                            {{ $errors->first() }}
                        </strong>
                        </span>
                    @endif
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" name="remember">
                    <label class="form-check-label" for="exampleCheck1">Remember Me.</label>
                </div>

                <div class="text-left mb-2">
                    <p>Not a member? &nbsp; <a href="#!" id="register_Trigger">Register</a></p>
                </div>
                <button type="submit" class="btn btn-primary w-25">Login</button>
            </form>
            {{-- REGISTERATION FORM --}}
            <form class="mx-auto w-100" id="register_Form" action="{{ route('register') }}" method="post">
                @csrf
                <h2 class="heading mt-4 mb-3 text-left">Register New Account.</h2>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Name</label>
                    <input type="text" class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}" id="exampleInputEmail1" aria-describedby="emailHelp" name="name">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control  {{ $errors->has('email') ? 'is-invalid' : '' }}" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
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
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                        <strong>
                            {{ $errors->first() }}
                        </strong>
                        </span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password_confirmation">
                </div>
                <div class="text-left mb-2">
                    <p>Already a member? &nbsp; <a href="#!" id="login_Trigger">Login</a></p>
                </div>
                <button type="submit" class="btn btn-primary w-25">Register</button>
            </form>
        </div>
    </div>
</div>