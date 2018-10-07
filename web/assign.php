<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Assignments</title>
        <?php
            $ROOT = ".";
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
                    <a href="index.php">
                        <div class="u-button">Home</div>  
                    </a>
                    <a href="#">
                        <div class="u-button">&gt; Assignments</div>  
                    </a>
                </div>
            </div>
            
            <?php
                $ASSIGNMENTS = array(
                    "01" => "Hello World",
                    "02" => "jQuery Test",
                    "03" => "Shopping Cart",
                    "04" => null,
                    "05" => null,
                    "06" => null,
                    "07" => null,
                    "08" => null,
                    "09" => null,
                    "10" => null,
                    "11" => null,
                    "12" => null,
                    "13" => null
                );
            ?>
            
            <div class="u-content">
                <div class="u-heading-2 u-center-text">Assignment List</div>
                <hr />
                <div class="u-button-container-large u-centered">
                    <?php $count = 1; foreach($ASSIGNMENTS as $weekNum => $title): ?>
                        <a href="<?php echo("week$weekNum/index.php"); ?>">
                            <div class="u-button u-button-large">
                                Week <?php echo("$count"); ?>
                                <?php if (isset($title)): ?>
                                    <hr class="u-dark-rule" />
                                    <?php echo("$title"); ?>
                                <?php endif ?>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="u-content u-media-on">
                <a href="index.php">
                    <div class="u-button">Home</div>  
                </a>
                <a href="#">
                    <div class="u-button">&gt; Assignments</div>  
                </a>
            </div>
        </div>
        
        <script src="./top.js"></script>
    </body>
</html>
