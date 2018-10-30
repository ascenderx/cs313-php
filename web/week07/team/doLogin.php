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

    if ($success) {
        login();
    } else {
        loginFail();
    }
?>