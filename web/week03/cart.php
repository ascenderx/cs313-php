<?php
    $fileName = "./store.json";
    $storeFile = fopen($fileName, "r") or die("Unable to read store.json");
    $itemsJSON = fread($storeFile, filesize($fileName));
    fclose($storeFile);
    $storeItems = json_decode($itemsJSON);
    
    session_start();
    
    foreach($storeItems as $item) {
        $sku = $item->sku;
        $count = htmlspecialchars($_POST["sku-$sku"]);
        $_SESSION["$sku-count"] = $count;
        $item->count = $_SESSION["$sku-count"];
    }
?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Shopping Cart</title>
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
                        <button class="u-button">Home</button>  
                    </a>
                    <a href="<?php echo($ROOT); ?>/assign.php">
                        <button class="u-button">&gt; Assignments</button>
                    </a>
                    <a href="./browse.php">
                        <button class="u-button">&gt; Store</button>  
                    </a>
                    <a href="#">
                        <button class="u-button">&gt; Shopping Cart</button>
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>