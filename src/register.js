// Teilaufgabe a)

// variables
var usernameOk = false;
var passwordOk = false;
var passwordsMatch = false;


// functions

function validateUsername() {
    fetch("ajax_check_user.php?user=" + document.getElementById('username').value)
    .then(res=>{
        //benutzername ist frei
        if (res.status === 404){
            changeBorderColorUsername(false);
        }
        else{
            changeBorderColorUsername(true);
        }
    })
}

// change the user input field border color 
function changeBorderColorUsername(nameTaken) {
    let inputField = document.getElementById('username');
    if (nameTaken) {
        inputField.style.borderColor = 'red';
        usernameOk = false;
    } else {
        inputField.style.borderColor = 'green';
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
    if (this.value.length < 3) {
        console.log('Username must be at least 3 characters long.');
        this.style.borderColor = 'red';
        passwordOk = false;
    } else {
        validateUsername();
    }
});

// Validate password strength
document.getElementById('password').addEventListener('input', function () {
    if (this.value.length < 8) {
        console.log('Password must be at least 8 characters long.');
        this.style.borderColor = 'red';
        passwordOk = false;
    } else {
        console.log('Password is strong enough.');
        this.style.borderColor = 'green';
        passwordOk = true;
    }

});

// Confirm password match
document.getElementById('password_repetition').addEventListener('input', function () {
    const pw1 = document.getElementById('password').value;
    if (this.value !== pw1) {
        console.log('Passwords do not match.');
        this.style.borderColor = 'red';
        passwordsMatch = false;
    } else {
        if (this.value.length > 1) {
            console.log('Passwords match.');
            this.style.borderColor = 'green';
            passwordsMatch = true;
        } else {
            console.log('Passwords do not match.');
        }
    }

});


