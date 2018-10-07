<?php
    session_start();
    
    $storeItems = $_SESSION["store-items"];
    foreach($storeItems as $item) {
        $sku = $item->sku;
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $count = intval($_POST["sku-$sku"]);
            if ($count < 0) {
                $count = 0;
            }
            $_SESSION["$sku-count"] = $count;
        }
        
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
                    <a href="./cart.php">
                        <button class="u-button">&gt; Shopping Cart</button>
                    </a>
                    <a href="#">
                        <button class="u-button">&gt; Checkout</button>
                    </a>
                </div>
            </div>
            
            <div class="u-content u-media-off">
                <form method="post">
                <?php foreach($storeItems as $item): ?>
                    <?php echo($item->sku); ?>
                    <?php echo($item->count); ?>
                    <br />
                <?php endforeach; ?>
                </form>
            </div>
        </div>
    </body>
</html>