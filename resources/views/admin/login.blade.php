@extends('partisals.layout')
@section('title', 'Login - The Travel Squad')

@section('section')
@include('partisals.formLayout')
@endsection

@section('script')
<script>
    var loginForm = document.getElementById("login_Form");
    var registerForm = document.getElementById("register_Form");
    var display = false;

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

    $(function() {
        $("#register_Form").on("submit", function(e) {
            var validate = {
                pass1: $("#Password1").val(),
                pass2: $("#Password2").val()
            }
            if (validate.pass1 != validate.pass2) {
                e.preventDefault();
                alert('Password and confirm password do not match')
            }
        });
    })
</script>
@endsection