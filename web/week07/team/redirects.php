<?php
    session_start();

    // https://stackoverflow.com/questions/5106313/redirecting-from-http-to-https-with-php
    function forceSSL() {
        $https = $_SERVER["HTTPS"];
        if (empty($http) || $http == "off") {
            $host = $_SERVER["HTTP_HOST"];
            $uri = $_SERVER["REQUEST_URI"];
            $redir = "https://$host$uri";

            header("HTTP/1.1 301 Moved Permanently");
            header("Location: $redir");
            exit();
        }
    }

    function checkUserCredentials() {
        $userKey = $_SESSION["user-key"];
        if (!isset($userKey) || empty($userKey)) {
            header("HTTP/1.1 401 Unauthorized");
            header("Location: login.php");
            exit();
        }
    }

    function checkLoginRedirect() {
        $userKey = $_SESSION["user-key"];
        if (isset($userKey) && !empty($userKey)) {
            header("HTTP/1.1 307 Temporary Redirect");
            header("Location: index.php");
            exit();
        }
    }

    function createLoginSession($username) {
        // generate a new random 16-bit key
        $userKey = openssl_random_pseudo_bytes(16);

        $_SESSION["user-key"] = $userKey;
        $_SESSION["username"] = $username;
        return $userKey;
    }

    function releaseLoginSession() {
        unset($_SESSION["user-key"]);
        unset($_SESSION["user-name"]);
    }

    function login() {
        createLoginSession();
        header("Location: index.php");
        exit();
    }

    function logout() {
        releaseLoginSession();
        header("Location: login.php");
        exit();
    }
?>