let txtUsername;
let txtPassword;
let txtConfirm;
let lblsError;

window.addEventListener('load', () => {
    txtUsername = document.getElementsByName('username')[0];
    txtPassword = document.getElementsByName('password')[0];
    txtConfirm = document.getElementsByName('confirm')[0];
    lblsError = document.getElementsByClassName('u-error');

    txtUsername.addEventListener('input', () => {
        toggleVisibility(verifyUsername, 1);
    });

    txtPassword.addEventListener('input', () => {
        toggleVisibility(verifyPassword, 2);
    });

    txtConfirm.addEventListener('input', () => {
        toggleVisibility(confirmPassword, 3);
    });
});

function toggleVisibility(checkCallback, labelIndex) {
    if (checkCallback()) {
        lblsError[labelIndex].style.visibility = 'hidden';
    } else {
        lblsError[labelIndex].style.visibility = 'visible';
    }
}

function verifyUsername() {
    txtUsername.value = txtUsername.value.trim();
    return txtUsername.value.length > 0;
}

function verifyPassword() {
    let password = txtPassword.value;
    return (
        password.length >= 7 &&
        password.length <= 124 &&
        password.search(/\d+/) >= 0
    );
}

function confirmPassword() {
    return txtConfirm.value === txtPassword.value;
}