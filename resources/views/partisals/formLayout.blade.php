<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-7 form_Container">
            {{-- LOGIN FORM --}}

            <form class="mx-auto" action="#" id="login_Form" method="post">
                @csrf
                <h2 class="heading mt-4 mb-3 text-left">Login To Your Account.</h2>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control  {{ $errors->has('email') ? 'is-invalid' : '' }}" id="emailLogin" aria-describedby="emailHelp" name="email">
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
                    <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password_confirmation">
                </div>
                <div class="text-left mb-2">
                    <p>Already a member? &nbsp; <span class="click_EventPrimaryForm" id="login_Trigger">Login</span></p>
                </div>
                <button type="submit" class="btn btn-primary w-25">Register</button>
            </form>
        </div>
        <div class="col-md-3 col-sm-12 col-lg-5 d-flex justify-content-center align-items-center imageSvgLogin">
            <img src="{{ asset('assets/loginSVG.svg') }}" alt="undraw-Authentication-re-svpt" width="95%">
        </div>
    </div>
</div>

<script>
    $(function () {
    $("#login_Form").on("submit",function(e){
    // e.preventDefault();
         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });
        $.ajax({
            url:'{{route("login")}}',
            method: 'post',
            data:  $("#login_Form").serialize(),
            contentType: false,
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(re){
                console.log(re);
            },
            error: function (jqXHR) {
                console.log(jqXHR.responseJSON);
                // console.log(data);
                console.log(jqXHR.responseJSON.message);
                // this will display errors on each request data
                $.each(jqXHR.responseJSON.errors, function (i, error) {
                    console.log(i, " : ", error[0]);
                });
            },
        });
    });
})
</script>

