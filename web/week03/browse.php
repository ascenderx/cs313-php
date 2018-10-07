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
                        <button class="u-button">&gt; Shopping Cart</button>  
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
                                <button class="u-button" name="itemCountDec">&ndash;</button>
                                <input type="text" name="itemCount" class="u-input-text u-input-small u-right-text" value="0" readonly />
                                <button class="u-button" name="itemCountInc">+</button>
                                <input class="u-button" type="submit" value="Add to cart" />
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