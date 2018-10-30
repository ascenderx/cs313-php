<?php
    /**
     * DO LOGIN
     * This is where the DB query code will go for logging in
     * for an existing user.
     */

    require("redirects.php");
    // forceSSL();

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

    // query the database
    $success = (function() {
        // add the db->query code here
        // return true or false depending on success
    })();

    // upon login, send the user to the welcome page
    if ($success) {
        login();
    // otherwise, send the user back with an error message
    } else {
        loginFail();
    }
?>