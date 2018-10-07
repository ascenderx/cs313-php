<?php
    session_start();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $addrStreet = htmlspecialchars($_POST["addr-street"]);
        $addr2 = htmlspecialchars($_POST["addr-2"]);
        $addrCity = htmlspecialchars($_POST["addr-city"]);
        $addrState = htmlspecialchars($_POST["addr-state"]);
        $addrZip = htmlspecialchars($_POST["addr-zip"]);
        $addrCountry = htmlspecialchars($_POST["addr-country"]);
    } else {
        die("Invalid redirect");
    }
    
    $storeItems = $_SESSION["store-items"];
    
    $tax = 8;
    $taxf = $tax / 100.0;
    $total = $_SESSION["total"];
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
                        <button class="u-button">&gt; Confirmation</button>
                    </a>
                </div>
            </div>
            
            <div class="u-content u-media-off">
                <div class="u-heading-2">Confirmation</div>
                <br /><br />
                
                <div class="u-heading-3">Items Purchased</div>
                <hr />
                <table>
                <tr>
                    <th>Name</th>
                    <th>SKU#</th>
                    <th colspan="2">Total Price</th>
                </tr>
                <?php foreach ($storeItems as $item): ?>
                    <tr>
                        <td><?php echo($item->name); ?></td>
                        <td>SKU<?php echo($item->sku); ?></td>
                        <td>$</td>
                        <td class="u-right-text"><?php echo(sprintf("%.2f", $item->count * $item->price)); ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td>Tax</td>
                    <td>@ <?php echo(sprintf("%.1f", $tax)); ?>%</td>
                    <td>$</td>
                    <td class="u-right-text"><?php echo(sprintf("%.2f", $taxf)); ?></td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Total</strong></td>
                    <td>$</td>
                    <td class="u-right-text"><?php echo($total); ?></td>
                </tr>
                <table>
                <br /><br />
                
                <div class="u-heading-3">Shipping Address</div>
                <hr />
                <?php echo($addrStreet); ?><br />
                <?php if ($addr2.length > 0) {
                    echo("$addr2<br />");
                } ?>
                <?php echo($addrCity); ?>, <?php echo($addrState); ?> <?php echo($addrZip); ?><br />
                <?php if ($addrCountry.length > 0) {
                    echo("$addrCountry<br />");
                } ?>
                <br /><br />
            </div>
        </div>
    </body>
</html>

<?php session_destroy(); ?>