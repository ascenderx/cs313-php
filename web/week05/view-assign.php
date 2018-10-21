<?php
    session_start();

    require("./modules/redirects.php");
    require('./modules/dbconnect.php');

    $user = $_SESSION["user"];
    if (!isset($user)) {
        loginRedirect();
    }

    $assign = htmlspecialchars(trim($_POST["assign-id"]));
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
                    <a href="./home.php">
                        <div class="u-button">&gt; Database (Read-only)</div>
                    </a>
                    <a href="#">
                        <div class="u-button">&gt; View Assignment</div>
                    </a>
                </div>
            </div>
            <div class="u-content u-media-off">
            <table class="u-fill">
            <tr>
                <td><span class="u-heading-2">View Assignment</span><td>
                <td class="u-right-text">
                    <a href="./home.php"><div class="u-button">Back</div></a>
                    <a href="./logout.php"><div class="u-button">Logout</div></a>
                </td>
            </tr>
            </table>
            <hr />
            <?php
                $stmt = $db->prepare("SELECT * FROM tasks WHERE assignment=:assign");
                $stmt->execute(array(":assign" => $assign));
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($rows) === 0):
            ?>
                The selected assignment currently has no tasks.
            <?php else: ?>
            <table class="u-left-text u-fill">
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Duration</th>
                    <th>Preemptable?</th>
                    <th>Required?</th>
                    <th>Status</th>
                </tr>
            <?php
                foreach ($rows as $row):
                    $id = $row["id"];
                    $name = $row["name"];
                    $desc = $row["description"];
                    $dur = $row["duration"];
                    $preempt = $row["preemptable"];
                    $req = $row["required"];
                    $stat = $row["status"];
            ?>
                <tr>
                    <td><?php echo($name); ?></td>
                    <td><?php
                        if (!empty($desc)) {
                            echo($desc);
                        } else {
                            echo("NULL");
                        }
                    ?></td>
                    <td><?php echo($dur); ?></td>
                    <td><?php echo(($preempt) ? "TRUE" : "FALSE"); ?></td>
                    <td><?php echo(($req) ? "TRUE" : "FALSE"); ?></td>
                    <td><?php echo($stat); ?></td>
                </tr>
            <?php endforeach; ?>
            </table>
            <?php endif; ?>
            </div>
        </div>
    </body>
</html>