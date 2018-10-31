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
        <style>
            .u-error {
                color: red;
                font-weight: bold;
            }
        </style>
        <?php if ($loginFailed): ?>
            <style>
                .u-error {
                    visibility: visible;
                }
            </style>
        <?php else: ?>
            <style>
                .u-error {
                    visibility: hidden;
                }
            </style>
        <?php endif; ?>
    </head>
    <body>
        <form method="post">
            <label class="u-error">
                Invalid username and/or password
            </label>
            <br />
            Username: <input type="text" name="username" />
            <label class="u-error">
                **
            </label>
            <br />
            Password: <input type="password" name="password" />
            <label class="u-error">
                **
            </label>
            <br />
            <input type="submit" formaction="doLogin.php" value="Sign In" />
            <input type="submit" formaction="register.php" value="Sign Up" />
        </form>
    </body>
</html>

<?php
    // this section resets the "fail" flag(s) so that if the user
    // refreshes the page, then any previous error messages will
    // not render
    resetFailFlags();
?>