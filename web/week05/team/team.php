<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Week 05 Team</title>
        <meta charset="UTF-8" />
    </head>
    <body>
        <?php
            try {
                $dbUrl = getenv('DATABASE_URL');
                
                $dbOpts = parse_url($dbUrl);
                
                $dbHost = $dbOpts["host"];
                $dbPort = $dbOpts["port"];
                $dbUser = $dbOpts["user"];
                $dbPassword = $dbOpts["pass"];
                $dbName = ltrim($dbOpts["path"],'/');
                
                $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
                
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $ex) {
                $msg = $ex->getMessage();
                echo "Error!: $msg";
                die();
            }
        ?>
        <h1>Scripture Resources</h1>
        <ul>
        <?php foreach ($db->query("SELECT * FROM public.scriptures") as $row): ?>
            <li>
                <strong>
                    <?php echo($row["book"]); ?>
                    <?php echo($row["chapter"]); ?>:<?php echo($row["verse"]); ?>
                </strong>
                &ndash;
                &ldquo;<?php echo($row["content"]); ?>&rdquo;
            </li>
        <?php endforeach; ?>
        </ul>
        <hr />
        <!--
            ################################################################################################################
            # LOOK AT THIS
            ################################################################################################################
        --> 
        <form method="POST">
            Book name: <input type="text" name="book" />
            <br />
            <input type="submit" value="Query" formaction="team2.php" />
        </form>
    </body>
</html>