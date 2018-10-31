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
        <style>
            .u-error {
                color: red;
                font-weight: bold;
            }
        </style>
        <?php if ($registerFailed): ?>
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
            Confirm password: <input type="password" name="confirm" />
            <label class="u-error">
                **
            </label>
            <br />
            <input type="submit" formaction="doRegister.php" value="Sign Up" />
        </form>
        <script type="application/javascript" src="register.js"></script>
    </body>
</html>

<?php
    // this section resets the "fail" flag(s) so that if the user
    // refreshes the page, then any previous error messages will
    // not render
    resetFailFlags();
?>