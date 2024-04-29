window.onload = function () {
    var nameInput = document.getElementById('name');
    var emailInput = document.getElementById('email');
    var passwordInput = document.getElementById('pass');
    var confirmPasswordInput = document.getElementById('cpass');
    nameInput.addEventListener('input', validateName);
    emailInput.addEventListener('input', validateEmail);
    passwordInput.addEventListener('input', validatePassword);
    confirmPasswordInput.addEventListener('input', validateConfirmPassword);
};
let valid = true;
function validateName() {
    var nameInput = document.getElementById('name');
    var nameError = document.getElementById('nameError');
    if (!nameInput.value) {
        nameError.innerHTML = 'Name Required field.';
        nameInput.classList.add('is-invalid');
        valid = false;
    } else if (!nameInput.value.match(/^[A-Za-z]+$/)) {
        nameError.innerHTML = 'Name should contain only alphabetic characters.';
        nameInput.classList.add('is-invalid');
        valid = false;
    } else if (nameInput.value.length < 8 || nameInput.value.length > 20) {
        nameError.innerHTML = 'Name should be 8-20 characters long.';
        nameInput.classList.add('is-invalid');
        valid = false;
    } else {
        nameError.innerHTML = '';
        nameInput.classList.remove('is-invalid');
        nameInput.classList.add('is-valid');
    }
}

function validateEmail() {
    var emailInput = document.getElementById('email');
    var emailError = document.getElementById('emailError');
    if (!emailInput.value) {
        emailError.innerHTML = 'Email Required';
        emailInput.classList.add('is-invalid');
        valid = false;
    } else if (!email.value.match(/^\S+@\S+\.\S+$/)) {
        emailError.innerHTML = 'Email should be a valid email address format (e.g., example@example.com).';
        emailInput.classList.add('is-invalid');
        valid = false;
    } else {
        emailError.innerHTML = '';
        emailInput.classList.remove('is-invalid');
        emailInput.classList.add('is-valid');
    }
}

function validatePassword() {
    var passwordInput = document.getElementById('pass');
    var passwordError = document.getElementById('passwordError');

    if (!passwordInput.value) {
        passwordError.innerHTML = 'Password Required.';
        passwordInput.classList.add('is-invalid');
        valid = false;
    }
    else if (!passwordInput.value.match(/^[A-Za-z0-9!@#$%^&*()]+$/)) {
        passwordError.innerHTML = 'Password should not contain spaces or emoji.';
        passwordInput.classList.add('is-invalid');
        valid = false;
    } else {
        passwordError.innerHTML = '';
        passwordInput.classList.remove('is-invalid');
        passwordInput.classList.add('is-valid');
    }
}


function validateConfirmPassword() {
    var confirmPasswordInput = document.getElementById('cpass');
    var confirmPasswordError = document.getElementById('confirmPasswordError');
    var passwordInput = document.getElementById('password');

    if (!confirmPasswordInput.value) {
        confirmPasswordError.innerHTML = 'Confirm Password Required field.';
        confirmPasswordInput.classList.add('is-invalid');
        valid = false;
    } else if (passwordInput.value !== confirmPasswordInput.value) {
        confirmPasswordError.innerHTML = 'Confirm Password should match the Password field.';
        confirmPasswordInput.classList.add('is-invalid');
        valid = false;
    } else {
        confirmPasswordError.innerHTML = '';
        confirmPasswordInput.classList.remove('is-invalid');
        confirmPasswordInput.classList.add('is-valid');
    }
}