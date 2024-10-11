// Returns true is there is a digit in string t
function hasDigit(t) {
    var regex = /\d/;
    return regex.test(t);
}

// Returns true is there is a uppercase letter in string t
function hasUppercase(t) {
    var regex = /[A-Z]/;
    return regex.test(t);
}

// Returns true is there is a lowercase letter in string t
function hasLowercase(t) {
    var regex = /[a-z]/;
    return regex.test(t);
}

// Returns true if form has valid data
function validateForm() {
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm_password").value;

    if (password !== confirmPassword) {
        alert("Passwords must be equals, try again...")
        return false
    }

    if (password.length < 8) {
        alert("Passwords must have at least 8 characters, try again...")
        return false
    }

    if (!hasDigit(password)) {
        alert("Passwords must include a digit, try again...")
        return false
    }

    if (!hasUppercase(password) || !hasLowercase(password)) {
        alert("Passwords must include upper and lower case, try again...")
        return false
    }

    return true;
}