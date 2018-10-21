<?php
    session_start();

    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    
    if (empty($username) || empty($password)) {
        $_SESSION["valid-credentials"] = "false";
        header("Location: index.php");
        exit;
    }

    $username = htmlspecialchars($username);
    $password = htmlspecialchars($password);

    require('./modules/dbconnect.php');
?>