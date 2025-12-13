// Teilaufgabe a)

// variables
var usernameOk = false;
var passwordOk = false;
var passwordsMatch = false;


// functions

function validateUsername() {
    fetch("ajax_check_user.php?user=" + document.getElementById('username').value)
        .then(res => {
            //benutzername ist frei
            if (res.status === 404) {
                changeBorderColorUsername(false);
            }
            else {
                changeBorderColorUsername(true);
            }
        })
}

// change the user input field border color 
function changeBorderColorUsername(nameTaken) {
    let inputField = document.getElementById('username');
    if (nameTaken) {
        inputField.classList.remove('is-valid');
        inputField.classList.add('is-invalid');
        usernameOk = false;
    } else {
        inputField.classList.remove('is-invalid');
        inputField.classList.add('is-valid');
        usernameOk = true;
    }
}

function canRegister() {
    if (usernameOk && passwordOk && passwordsMatch) {
        return true;
    } else {
        return false;
    }
}

// Validate username length
document.getElementById('username').addEventListener('input', function () {
    document.getElementById('formregister').classList.remove('was-validated');
    if (this.value.length < 3) {
        console.log('Username must be at least 3 characters long.');
        //this.style.borderColor = 'red';
        passwordOk = false;
    } else {
        validateUsername();
    }
});

// Validate password strength
document.getElementById('password').addEventListener('input', function () {
    if (this.value.length < 8) {
        console.log('Password must be at least 8 characters long.');
        this.classList.remove('is-valid');
        this.classList.add('is-invalid');
        passwordOk = false;
    } else {
        console.log('Password is strong enough.');
        this.classList.remove('is-invalid');
        this.classList.add('is-valid');
        passwordOk = true;
    }

});

// Confirm password match
document.getElementById('password_repetition').addEventListener('input', function () {
    const pw1 = document.getElementById('password').value;
    if (this.value !== pw1) {
        console.log('Passwords do not match.');
        this.classList.remove('is-valid');
        this.classList.add('is-invalid');
        passwordsMatch = false;
    } else {
        if (this.value.length > 1) {
            console.log('Passwords match.');
            this.classList.remove('is-invalid');
            this.classList.add('is-valid');
            passwordsMatch = true;
        } else {
            console.log('Passwords do not match.');
        }
    }

});

// Handle form submission
const form = document.getElementById('registerform');
form.addEventListener('submit', function (event) {
    if (!form.checkValidity() || !canRegister()) {
        event.preventDefault(); // Prevent form submission
        event.stopPropagation();
        console.log('Form submission prevented. Please correct the errors and try again.');
    } else {
        console.log('Form submitted successfully.');
    }
    //form.classList.add('was-validated');
}, false);

