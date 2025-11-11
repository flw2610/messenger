// Teilaufgabe a)

// functions

function validateUsername() {
    let name = document.getElementById("username").value;
    let res = false;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4) {
            if (xmlhttp.status == 204) {
                console.log("Exists");
                changeBorderColorUsername(true);
            } else if (xmlhttp.status == 404) {
                console.log("Does not exist");
                changeBorderColorUsername(false);
            }
        }
    };
    xmlhttp.open("GET", backendUrl + "/user/" + name, true);
    xmlhttp.send();
    return res;
}

// change the user input field border color 
function changeBorderColorUsername(nameTaken) {
    let inputField = document.getElementById('username');
    if (nameTaken) {
        inputField.style.borderColor = 'red';
    } else {
        inputField.style.borderColor = 'green';
    }
}

// Validate username length
document.getElementById('username').addEventListener('input', function () {
    if (this.value.length < 3) {
        console.log('Username must be at least 3 characters long.');
        this.style.borderColor = 'red';
    } else {
        validateUsername();
        
    }

});

// Validate password strength
document.getElementById('pw1').addEventListener('input', function () {
    if (this.value.length < 8) {
        console.log('Password must be at least 8 characters long.');
        this.style.borderColor = 'red';
    } else {
        console.log('Password is strong enough.');
        this.style.borderColor = 'green';
    }

});

// Confirm password match
document.getElementById('pw2').addEventListener('input', function () {
    const pw1 = document.getElementById('pw1').value;
    if (this.value !== pw1) {
        console.log('Passwords do not match.');
        this.style.borderColor = 'red';
    } else {
        console.log('Passwords match.');
        this.style.borderColor = 'green';
    }

});

document.getElementById('registerButton').disabled = true;