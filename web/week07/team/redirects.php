<?php
    session_start();

    /**
     * FORCE SSL & HTTPS
     * This will force the user to user HTTPS (port 443) if he/she navigated here
     * using HTTP (port 80).
     */
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

    /**
     * CHECK USER CREDENTIALS AND (CONDITIONALLY) REDIRECT
     * This will check to see if a user session key is currently available.
     * If not, then the user is redirected to the login page.
     */
    function checkUserCredentials() {
        $userKey = $_SESSION["user-key"];
        if (!isset($userKey) || empty($userKey)) {
            header("HTTP/1.1 401 Unauthorized");
            header("Location: login.php");
            exit();
        }
    }

    /**
     * CHECK LOGIN AND (CONDITIONALLY) REDIRECT
     * This will check to see if a user session key is currently available.
     * If so, then the user is redirected to the welcome page.
     */
    function checkLoginAndRedirect() {
        $userKey = $_SESSION["user-key"];
        if (isset($userKey) && !empty($userKey)) {
            header("HTTP/1.1 307 Temporary Redirect");
            header("Location: index.php");
            exit();
        }
    }

    /**
     * REDIRECT LOGIN FAILED
     * This will set a failure flag and redirect the user to the login page.
     */
    function loginFail() {
        $_SESSION["login-fail"] = "true";
        header("HTTP/1.1 400 Bad Request");
        header("Location: login.php");
        exit();
    }

    /**
     * REDIRECT REGISTER FAILED
     * This will set a failure flag and redirect the user to the register page.
     */
    function registerFail() {
        $_SESSION["register-fail"] = "true";
        header("HTTP/1.1 400 Bad Request");
        header("Location: register.php");
        exit();
    }

    /**
     * RESET FAILURE FLAGS
     * This will reset all failure flags.
     */
    function resetFailFlags() {
        unset($_SESSION["login-fail"]);
        unset($_SESSION["register-fail"]);
    }

    /**
     * CREATE LOGIN SESSION [HELPER FUNCTION]
     * Called by login().
     * This function creates a new session key and adds the key and
     * the username to the session global.
     */
    function createLoginSession($username) {
        // generate a new random 16-bit key
        $userKey = openssl_random_pseudo_bytes(16);
        unset($_SESSION["login-fail"]);

        $_SESSION["user-key"] = $userKey;
        $_SESSION["username"] = $username;
        return $userKey;
    }

    /**
     * RELEASE LOGIN SESSION [HELPER FUNCTION]
     * Called by logout().
     * This removes the session key and username from the session global.
     */
    function releaseLoginSession() {
        unset($_SESSION["user-key"]);
        unset($_SESSION["username"]);
    }

    /**
     * REDIRECT LOG IN
     * This successfully logs the user in to the subsite, redirecting
     * him/her to the welcome page.
     */
    function login($username) {
        createLoginSession($username);
        header("Location: index.php");
        exit();
    }

    /**
     * REDIRECT LOG OUT
     * This successfully log the user out of the subsite, redirecting
     * him/her to the login page.
     */
    function logout() {
        releaseLoginSession();
        header("Location: login.php");
        exit();
    }
?>