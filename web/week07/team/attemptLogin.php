<?php
    require("redirects.php");
    // forceSSL();

    // this is where the DB query code will go for logging in
    // for an existing user

    function isPopulated($val) {
        return isset($val) && !empty($val) && !empty(trim($val));
    }
    
    // get details
    $username = $_POST["username"];
    $password = $_POST["password"];

    // check if valid
    $validUsername = isPopulated($username);
    $validPassowrd = isPopulated($password);
    if (!$validUsername || !$validPassword) {
        loginFail();
    }

    // sanitize input
    $username = htmlspecialchars($username);
    $password = htmlspecialchars($password);
?>