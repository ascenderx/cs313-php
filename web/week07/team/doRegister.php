<?php
    /**
     * DO REGISTER
     * This is where the DB query code will go for signing up
     * as a new user.
     */

    require("redirects.php");
    // forceSSL();

    function isPopulated($val) {
        return isset($val) && !empty($val) && !empty(trim($val));
    }
    
    // get details
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm = $_POST["confirm"];

    // check if valid
    $PASSWORD_MIN_LENGTH = 7;
    $PASSWORD_MAX_LENGTH = 124;
    $validUsername = isPopulated($username);
    
    // perfom a regex search for at least one digit in $password
    $passwordHasDigits = preg_match("/\d+/", $password) === 1;
    $validPassword = (
        isPopulated($password) &&
        strlen($password) >= $PASSWORD_MIN_LENGTH &&
        strlen($password) <= $PASSWORD_MAX_LENGTH &&
        $password == $confirm &&
        $passwordHasDigits
    );
    if (!$validUsername || !$validPassword) {
        registerFail();
    }

    // sanitize input
    $username = htmlspecialchars($username);
    $password = htmlspecialchars($password);
    $password = password_hash($password, PASSWORD_DEFAULT);

    // query the database
    try {
        require("dbconnect.php");
        
        // add the db->query code here
        $stmt = $db->prepare("INSERT INTO teach07_user (username, password) VALUES (:username, :password);");
        $stmt->execute(array(
            ":username" => $username,
            ":password" => $password
        ));

        $success = true;
    } catch (PDOException $ex) {
        $success = false;
    }

    // upon registration, redirect the user to the login page
    if ($success) {
        logout();
    // otherwise, send the user back with an error message
    } else {
        registerFail();
    }
?>