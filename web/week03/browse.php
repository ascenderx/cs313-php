<?php
    $fileName = "./store.json";
    $storeFile = fopen($fileName, "r") or die("Unable to read store.json");
    $itemsJSON = fread($storeFile, filesize($fileName));
    fclose($storeFile);
    $storeItems = json_decode($itemsJSON);
    
    session_start();
    
    foreach($storeItems as $item) {
        $sku = $item->sku;
        if (!isset($_SESSION["$sku-count"])) {
            $_SESSION["$sku-count"] = 0;
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
                    <a href="#">
                        <button class="u-button">&gt; Store</button>  
                    </a>
                </div>
            </div>
            
            <div class="u-content u-media-off">
                <form method="POST" action="cart.php">
                <table class="u-fill">
                    <tr>
                    <td class="u-pull-left">
                        <button id="btViewCart" type="submit" class="u-button">View Cart</button>
                    </td>
                    </tr>
                </table>
                <hr />
                <?php foreach ($storeItems as $item): ?>
                    <div>
                        <span class="u-heading-3"><?php echo($item->name); ?> Meme</span>
                        <table class="u-fill">
                            <tr>
                                <td rowspan="0" class="u-store-img-container">
                                <img src="./assets/images/<?php echo($item->image); ?>" alt="meme" class="u-store-img" />
                                </td>
                            </tr>
                            <tr>
                                <td valign="top"><?php echo($item->description); ?></td>
                            </tr>
                            <tr>
                                <td valign="top">SKU<?php echo($item->sku); ?></td>
                            </tr>
                            <tr>
                                <td valign="top">$<?php echo($item->price); ?></td>
                            </tr>
                            <tr>
                                <td>
                                <button class="u-button" id="itemCountDec" type="button">&ndash;</button>
                                <input
                                    type="text"
                                    id="itemCount"
                                    name="sku-<?php echo($item-sku); ?>"
                                    class="u-input-text u-input-small u-right-text"
                                    value="<?php echo($item->count); ?>"
                                    readonly />
                                <button class="u-button" id="itemCountInc" type="button">+</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <hr />
                <?php endforeach; ?>
                </form>
            </div>
        </div>
        
        <script src="./browse.js"></script>
    </body>
</html>