<?php
    session_start();
    $book = $_SESSION("book");
    $row = $_SESSION("$book");
    echo($book);
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Week 05 Team</title>
        <meta charset="UTF-8" />
    </head>
    <body>
        <h1>Scripture Details</h1>
        
        <?php
            $bookName = $row["book"];
            $chapter = $row["chapter"];
            $verse = $row["verse"];
            $content = $row["content"];
            echo("$bookName $chapter:$verse &ldquo;$content&rdquo;");
        ?>
    </body>
</html>
<?php
    session_destroy();
?>