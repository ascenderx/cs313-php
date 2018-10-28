<?php
    session_start();

    require("./modules/redirects.php");
    // require('./modules/dbconnect.php');

    $user = $_SESSION["user"];
    $name = $_SESSION["name"];
    if (!isset($user)) {
        loginRedirect();
    }
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Database | Home</title>
        <?php
            $ROOT = ".."; 
            $MODULE_DIR = "$ROOT/modules";
            require("$MODULE_DIR/metadata.php");
        ?>
    </head>
    <body>
        <?php require("$MODULE_DIR/sidebar.php"); ?>
        <div class="u-container">
            <?php require("$MODULE_DIR/header.php"); ?>

            <div class="u-content u-media-off">
                <div class="u-button-container-auto u-centered">
                    <a href="<?=$ROOT ?>/index.php">
                        <div class="u-button">Home</div>  
                    </a>
                    <a href="<?=$ROOT ?>/assign.php">
                        <div class="u-button">&gt; Assignments</div>  
                    </a>
                    <a href="./home.php">
                        <div class="u-button">&gt; Database (Read-write)</div>
                    </a>
                </div>
            </div>

            <div class="u-content">
                <table class="u-fill">
                <tr>
                    <td><span class="u-heading-2">Home</span><td>
                    <td class="u-right-text">
                        <a href="./logout.php"><div class="u-button">Logout</div></a>
                    </td>
                </tr>
                </table>
                <hr />
                Welcome, <?=$name ?>!<br />
                What would you like to do?<br />
                <a href="./view-assign.php"><div class="u-button">View Assignments</div></a>
                <a href="#"><div class="u-button">Start Timer</div></a>
                <table>
                </table>
            </div>
        </div>
        <?php require("$MODULE_DIR/dialog.php"); ?>
        <div class="u-page-mask"></div>
        <div class="u-dialog">
            <div class="u-dialog-header u-heading-2"></div>
            <hr />
            <div class="u-dialog-content"></div>
            <div class="u-button u-dialog-close">Close</div>
        </div>

        <script type="application/javascript" src="./modules/timer.js"></script>
        <script type="application/javascript" src="./scripts/view-assign.js"></script>
        <script type="application/javascript" src="./scripts/home.js"></script>
    </body>
</html>