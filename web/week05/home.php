<?php
    session_start();

    require("./modules/redirects.php");

    $user = $_SESSION["user"];
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
                    <a href="<?php echo($ROOT); ?>/index.php">
                        <div class="u-button">Home</div>  
                    </a>
                    <a href="<?php echo($ROOT); ?>/assign.php">
                        <div class="u-button">&gt; Assignments</div>  
                    </a>
                    <a href="#">
                        <div class="u-button">&gt; Database (Read-only)</div>
                    </a>
                </div>
            </div>

            <div class="u-content u-media-off">
                <div class="u-right-text">
                    <a href="./logout.php"><div class="u-button">Logout</div></a>
                </div>
            </div>
        </div>
    </body>
</html>