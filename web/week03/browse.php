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
                        <div class="u-button">Home</div>  
                    </a>
                    <a href="#">
                        <div class="u-button">&gt; Shopping Cart</div>  
                    </a>
                </div>
            </div>
            
            <?php
                $fileName = "./store.json";
                $storeFile = fopen($fileName, "r") or die("Unable to read store.json");
                $itemsJSON = fread($storeFile, filesize($fileName));
                fclose($storeFile);
                $storeItems = json_decode($itemsJSON);
            ?>
            
            <div class="u-content u-media-off">
                <?php foreach ($storeItems as $item): ?>
                    <div>
                        <table class="u-fill">
                            <tr>
                                <td valign="top">SKU</td>
                                <td valign="top"><?php echo($item->sku); ?></td>
                            </tr>
                            <tr>
                                <td valign="top">Name</td>
                                <td valign="top"><?php echo($item->name); ?></td>
                            </tr>
                            <tr>
                                <td valign="top">Description</td>
                                <td valign="top"><?php echo($item->description); ?></td>
                            </tr>
                            <tr>
                                <td valign="top">Price</td>
                                <td valign="top">$<?php echo($item->price); ?></td>
                                <td class="u-pull-right">
                                <div class="u-button" name="itemCountDec">&ndash;</div>
                                <input type="text" name="itemCount" class="u-input-text u-input-small u-right-text" value="0" readonly />
                                <div class="u-button" name="itemCountInc">+</div>
                                <div class="u-button">Add to cart</div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <hr />
                <?php endforeach; ?>
            </div>
        </div>
        
        <script src="./browse.js"></script>
    </body>
</html>