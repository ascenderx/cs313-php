<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Homepage</title>
        <?php 
            $ROOT = ".";
            $MODULE_DIR = "$ROOT/modules";
            require("$MODULE_DIR/metadata.php");
        ?>
    </head>
    <body>
        <?php require("$MODULE_DIR/sidebar.php"); ?>
        <div class="u-container">
            <?php
                require("$MODULE_DIR/header.php");
                require("$MODULE_DIR/osinfo.php");
            ?>
        </div>
        
        <script src="./top.js"></script>
    </body>
</html>
