require('./app')

var loginForm = document.getElementById('login_Form');
var registerForm = document.getElementById('register_Form');


var loginTrigger = document.getElementById('login_Trigger').addEventListener('click', function(){
    loginForm.style.left = "0%";
    registerForm.style.left = "150%";
});

var registerTrigger = document.getElementById('register_Trigger').addEventListener('click', function(){
    loginForm.style.left = "150%";
    registerForm.style.left = "0%";
})