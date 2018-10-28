<?php
    function loginFail() {
        $_SESSION["valid-credentials"] = "false";
        header("Location: /week06/index.php");
        exit;
    }

    function loginRedirect() {
        $_SESSION["valid-credentials"] = null;
        header("Location: /week06/index.php");
        exit;
    }

    function logout() {
        $_SESSION["user"] = null;
        $_SESSION["name"] = null;
        unset($_SESSION["user"]);
        loginRedirect();
    }

    function loginSuccess($userKey, $name) {
        $_SESSION["user"] = $userKey;
        $_SESSION["name"] = $name;
        $_SESSION["valid-credentials"] = null;
        header("Location: /week06/home.php");
        exit;
    }
?>