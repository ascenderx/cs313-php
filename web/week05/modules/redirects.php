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

    function logout() {
        $_SESSION["user"] = null;
        $_SESSION["name"] = null;
        unset($_SESSION["user"]);
        loginRedirect();
    }

    function loginSuccess($username, $name) {
        $_SESSION["user"] = $username;
        $_SESSION["name"] = $name;
        $_SESSION["valid-credentials"] = null;
        header("Location: home.php");
        exit;
    }
?>