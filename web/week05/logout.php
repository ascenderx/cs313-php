<?php
    session_start();

    require("./modules/redirects.php");

    $_SESSION["user"] = null;
    unset($_SESSION["user"]);
    loginRedirect();
?>