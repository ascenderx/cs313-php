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
    $validPassword = isPopulated($password);
    if (!$validUsername || !$validPassword) {
        loginFail();
    }

    // sanitize input
    $username = htmlspecialchars($username);
    $password = htmlspecialchars($password);

    // query the database
    try {
        require("dbconnect.php");

        // add the db->query code here
        $stmt = $db->prepare("SELECT password FROM teach07_user WHERE username = :username;");
        $stmt->execute(array(
            ":username" => $username
        ));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $hash = $row["password"];
        $success = password_verify($password, $hash);
    } catch (PDOException $ex) {
        $success = false;
    }

    // upon login, send the user to the welcome page
    if ($success) {
        login($username);
    // otherwise, send the user back with an error message
    } else {
        loginFail();
    }
?>