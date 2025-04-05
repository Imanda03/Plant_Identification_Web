// const form = document.getElementById('login-form');
// const username = document.getElementById('username');
// const email = document.getElementById('email');
// const password = document.getElementById('password');
// const password2 = document.getElementById('password2');

// function showError(input, message) {
//     const formControl = input.parentElement;
//     formControl.className = 'form-control error';
//     const small = formControl.querySelector('small');
//     small.innerText = message
// }

// function showSuccess(input) {
//     const formControl = input.parentElement;
//     formControl.className = 'form-control success'
// }

// function isValidEmail(email) {

// }

// form.addEventListener('submit', function(e) {
//     e.preventDefault();

//     if (username.value === '') {
//         showError(username, 'username is required');

//     } else {
//         showSuccess(username);
//     }

//     if (email.value === '') {
//         showError(email, 'email is required');

//     } else {
//         showSuccess(email);
//     }

//     if (password.value === '') {
//         showError(password, 'password is required');

//     } else {
//         showSuccess(password);
//     }

//     if (password2.value === '') {
//         showError(password2, 'confirm password is required');

//     } else {
//         showSuccess(password2);
//     }
//     if(password != password2){

//         showError(this.inputMode,'password doesnot match')
//     }

// })
// js for toggle form

    var loginform = document.getElementById("login-form");
    var regform = document.getElementById("reg-form");
    var indicator = document.getElementById("indicator");

    function register(){
        
    regform.style.transform = "translateX(300px)";
        loginform.style.transform = "translateX(300px)";
        indicator.style.transform = "translateX(0px)";
    }

    function login(){
        regform.style.transform = "translateX(0px)";
        loginform.style.transform = "translateX(0px)";
        indicator.style.transform = "translateX(100px)";

    }
  