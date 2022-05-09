
var loginForm = document.getElementById('login_Form');
var registerForm = document.getElementById('register_Form');

document.getElementById('register_Trigger').addEventListener('click', function(){
    loginForm.classList.add('d-none');
    registerForm.classList.remove('d-none');
});

document.getElementById('login_Trigger').addEventListener('click', function(){
    loginForm.classList.remove('d-none');
    registerForm.classList.add('d-none');
});



$(function(){
    $('login_Form').on('submit', function(e){
        e.preventDefault();
    });
});