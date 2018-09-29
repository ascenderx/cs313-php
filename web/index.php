<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Homepage</title>
        <?php $MODULE_DIR = $_SERVER["DOCUMENT_ROOT"] . "/modules" ?>
        <?php include $MODULE_DIR . "/metadata.php" ?>
    </head>
    <body>
        <?php include $MODULE_DIR . "/sidebar.php" ?>
        <div class="u-container">
            <?php include $MODULE_DIR . "/header.php" ?>
            <?php include $MODULE_DIR . "/osinfo.php" ?>
        </div>
        
        <script src="./top.js"></script>
    </body>
</html>
