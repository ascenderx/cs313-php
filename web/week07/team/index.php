<?php
    /**
     * WELCOME PAGE
     */

    require("redirects.php");
    // forceSSL();
    checkUserCredentials();

    $username = $_SESSION["username"];
?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>CS 313 | Welcome</title>
        <meta charset="UTF-8" />
    </head>
    <body>
        Welcome, <?=$username ?>!<br />
        <form method="GET">
            <input type="submit" formaction="doLogout.php" value="Sign Out" />
        </form>
    </body>
</html>