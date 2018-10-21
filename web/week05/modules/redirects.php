<?php
    function loginFail() {
        $_SESSION["valid-credentials"] = "false";
        header("Location: index.php");
        exit;
    }

    function loginRedirect() {
        $_SESSION["valid-credentials"] = null;
        header("Location: index.php");
        exit;
    }

    function loginSuccess($username) {
        $_SESSION["user"] = $username;
        $_SESSION["valid-credentials"] = null;
        header("Location: home.php");
        exit;
    }
?>