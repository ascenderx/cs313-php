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
                    <a href="#">
                        <button class="u-button">&gt; Shopping Cart</button>
                    </a>
                </div>
            </div>
            
            <div class="u-content u-media-off">
                <form method="post">
                <table class="u-fill">
                    <tr>
                    <td class="u-pull-left">
                        <button id="btCheckout" type="submit" class="u-button" formaction="./checkout.php">Checkout</button>
                    </td>
                    </tr>
                </table>
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
                                    <?php echo($item->count); ?> @ $<?php echo(sprintf("%.2f", $item->price)); ?>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <strong>Subtotal:</strong> $<?php echo(sprintf("%.2f", $item->count * $item->price)); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <button class="u-button" ident="itemRemove" type="submit" formaction="./cart.php">Remove Item</button>
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