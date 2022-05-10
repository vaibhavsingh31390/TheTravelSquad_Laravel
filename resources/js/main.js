var loginForm = document.getElementById("login_Form");
var registerForm = document.getElementById("register_Form");


document
    .getElementById("register_Trigger")
    .addEventListener("click", function () {
        loginForm.classList.add("d-none");
        registerForm.classList.remove("d-none");
    });

document.getElementById("login_Trigger").addEventListener("click", function () {
    loginForm.classList.remove("d-none");
    registerForm.classList.add("d-none");
});


;



// $(function () {
//     $("#login_Form").on("submit", function (e) {
//         e.preventDefault();
//         var rememberVal = false;
//         if ($("#rememberLogin").is(":checked")) {
//             var rememberVal = true;
//         }
//         var formData = {
//             token: $('input[name="_token"]').val(),
//             email: $("#emailLogin").val(),
//             password: $("#passwordLogin").val(),
//             remember: rememberVal,
//         };
//         $.ajaxSetup({
//             headers: {
//                 "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//             },
//         });
//         $.ajax({
//             headers: {
//                 "Content-Type": "application/json",
//             },
//             type: "POST",
//             url: "/login",
//             dataType: 'json',
//             contentType: false,    
//             processData: false,
//             cache: false,
//             data: {
//                 '_token': formData.token,
//                 'email': formData.email,
//                 'password': formData.password,
//                 'remember': formData.remember,
//             },
//             success: function (data) {
//                 console.log(data);
//             },
//             error: function (jqXHR) {
//                 console.log(jqXHR.responseJSON);
//                 // console.log(data);
//                 console.log(jqXHR.responseJSON.message);
//                 // this will display errors on each request data
//                 $.each(jqXHR.responseJSON.errors, function (i, error) {
//                     console.log(i, " : ", error[0]);
//                 });
//             },
//         });
//     });
// });

// var dd = $('#login_Form').serialize();
// console.log(dd);
// $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
// });
// $.ajax({
//     type: "POST",
//     url: "/login",
//     dataType: 'json',
//     contentType: false,
//     processData: false,
//     data: $('#login_Form').serialize(),
//     cache: false,
//     success: function (response) {

//         console.log('success');

//     },
//     error: function (jqXHR) {
//         console.log(jqXHR.responseJSON);
//         console.log(jqXHR.responseJSON.message);
//         // this will display errors on each request data
//         $.each(jqXHR.responseJSON.errors, function (i, error) {
//             console.log(i, " : ", error[0]);
//         });
//     }
// })

































