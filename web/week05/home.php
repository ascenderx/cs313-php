<?php
    session_start();

    require("./modules/redirects.php");
    require('./modules/dbconnect.php');

    $user = $_SESSION["user"];
    $name = $_SESSION["name"];
    if (!isset($user)) {
        loginRedirect();
    }
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Database | Home</title>
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
                    <a href="<?php echo($ROOT); ?>/assign.php">
                        <div class="u-button">&gt; Assignments</div>  
                    </a>
                    <a href="#">
                        <div class="u-button">&gt; Database (Read-only)</div>
                    </a>
                </div>
            </div>

            <div class="u-content u-media-off">
                <table class="u-fill">
                <tr>
                    <td><span class="u-heading-2">Home</span><td>
                    <td class="u-right-text">
                        <a href="./logout.php"><div class="u-button">Logout</div></a>
                    </td>
                </tr>
                </table>
                <hr />
                Welcome, <?php echo($name); ?>!<br />
                Please select the assignment to view:<br />
                <table>
                <?php
                    $query = "SELECT * FROM assignments";
                    foreach ($db->query($query) as $row):
                        $id = $row["id"];
                        $name = $row["name"];
                ?>
                    <tr>
                    <form method="POST">
                        <td style="display: none;">
                            <input type="text" name="assign-id" value="<?php echo($id); ?>" readonly />
                        </td>
                        <td><button type="submit" class="u-button" formaction="view-assign.php">View</button></td>
                        <td><?php echo($name); ?></td>
                    </form>
                    </tr>
                <?php endforeach; ?>
                </table>
            </div>
        </div>
    </body>
</html>