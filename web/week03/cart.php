<?php
    /*
    $fileName = "./store.json";
    $storeFile = fopen($fileName, "r") or die("Unable to read store.json");
    $itemsJSON = fread($storeFile, filesize($fileName));
    fclose($storeFile);
    $storeItems = json_decode($itemsJSON);
    */
    
    session_start();
    
    $storeItems = $_SESSION["store-items"];
    foreach($storeItems as $item) {
        $sku = $item->sku;
        $count = intval($_POST["sku-$sku"]);
        if ($count < 0) {
            $count = 0;
        }
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
            
            <div class="u-content u-media-off">
                <form method="post" action="checkout.php">
                <table class="u-fill">
                    <tr>
                    <td valign="center" class="u-pull-left">
                        <strong>Cart Subtotal:</strong>
                        $<?php
                            $subtotal = 0;
                            foreach ($storeItems as $item) {
                                $itemSubtotal = $item->count * $item->price;
                                $subtotal += $itemSubtotal;
                            }
                            echo(sprintf("%.2f", $subtotal));
                        ?>
                    </td>
                    </tr>
                    <tr>
                    <td class="u-pull-left">
                        <button id="btCheckout" type="submit" class="u-button">Checkout</button>
                    </td>
                    </tr>
                </table>
                </form>
                <form method="post" action="">
                <hr />
                <?php foreach ($storeItems as $item): ?>
                <?php if ($item->count > 0): ?>
                    <div ident="itemDiv">
                        <span class="u-heading-3"><?php echo($item->name); ?> Meme</span>
                        <table class="u-fill">
                            <tr>
                                <td rowspan="0" class="u-store-img-container">
                                <img src="./assets/images/<?php echo($item->image); ?>" alt="meme" class="u-store-img" />
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">SKU<?php echo($item->sku); ?></td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <input
                                        type="number"
                                        ident="itemCount"
                                        name="sku-<?php echo($item->sku); ?>"
                                        class="u-no-show"
                                        value="<?php echo($item->count); ?>" />
                                    <?php echo($item->count); ?> @ $<?php echo($item->price); ?>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <strong>Subtotal:</strong> $<?php echo($item->count * $item->price); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <button class="u-button" ident="itemRemove" type="button">Remove Item</button>
                                </td>
                            </tr>
                        </table>
                        <hr />
                    </div>
                <?php endif; ?>
                <?php endforeach; ?>
                </form>
            </div>
        </div>
        
        <script src="./cart.js"></script>
    </body>
</html>