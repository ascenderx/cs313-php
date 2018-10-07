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
    
    $tax = 8;
    $taxf = $tax / 100.0;
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
                <div class="u-heading-3">Cart Amounts</div>
                <hr />
                <form method="post">
                    <table>
                    <tr>
                        <td><strong>Cart Subtotal</strong></td>
                        <td>$</td>
                        <td class="u-right-text"><?php
                            $subtotal = 0;
                            foreach ($storeItems as $item) {
                                $itemSubtotal = $item->count * $item->price;
                                $subtotal += $itemSubtotal;
                            }
                            echo(sprintf("%.2f", $subtotal));
                        ?></td>
                    </tr>
                    <tr>
                        <td class="u-bottom-border"><strong>Tax @ <?php echo($tax); ?>%</strong></td>
                        <td class="u-bottom-border">$</td>
                        <td class="u-right-text u-bottom-border"><?php echo(sprintf("%.2f", $subtotal * $taxf)); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Total</strong></td>
                        <td>$</td>
                        <td class="u-right-text"><?php echo(sprintf("%.2f", $subtotal * (1 + $taxf))); ?></td>
                    </tr>
                    </table>
                    <br /><br />
                    
                    <div class="u-heading-3">Shipping Address</div>
                    <hr />
                    <span class="u-warning">*</span> Required Field
                    <table>
                    <tr>
                        <td>Address 1<span class="u-warning">*</span></td>
                        <td><input type="text" class="u-input-text" name="addr-street" /></td>
                    </tr>
                    <tr>
                        <td>Address 2</td>
                        <td><input type="text" class="u-input-text" name="addr-2" /></td>
                    </tr>
                    <tr>
                        <td>City<span class="u-warning">*</span></td>
                        <td><input type="text" class="u-input-text" name="addr-city" /></td>
                    </tr>
                    <tr>
                        <td>State / Province<span class="u-warning">*</span></td>
                        <td><input type="text" class="u-input-text" name="addr-state" /></td>
                    </tr>
                    <tr>
                        <td>Zip Code<span class="u-warning">*</span></td>
                        <td><input type="text" class="u-input-text" name="addr-zip" /></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td><input type="text" class="u-input-text" name="addr-country" /></td>
                    </tr>
                    <tr>
                        <td>
                            <button 
                                id="bt-checkout"
                                type="submit"
                                class="u-button"
                                formaction="./confirm.php"
                                disabled="true">Submit Payment</button>
                        </td>
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>