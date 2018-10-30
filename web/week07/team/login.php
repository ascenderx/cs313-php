<?php
    /**
     * SIGN IN PAGE
     */

    require("redirects.php");
    // forceSSL();
    checkLoginAndRedirect();

    $loginFailed = ($_SESSION["login-fail"] == "true");
?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>CS 313 | Sign In</title>
        <meta charset="UTF-8" />
    </head>
    <body>

    </body>
</html>

<?php
    // this section resets the "fail" flag(s) so that if the user
    // refreshes the page, then any previous error messages will
    // not render
    resetFailFlags();
?>