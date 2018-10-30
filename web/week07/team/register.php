<?php
    /**
     * SIGN UP PAGE
     */

    require("redirects.php");
    // forceSSL();

    $registerFailed = ($_SESSION["register-fail"] == "true");
?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>CS 313 | Register</title>
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