<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Week 05 Team</title>
        <meta charset="UTF-8" />
    </head>
    <body>
        <h1>Scripture Details</h1>
        
        <?php
            $book = htmlspecialchars($_POST["book"]);
            $chapter = htmlspecialchars($_POST["chapter"]);
            $verse = htmlspecialchars($_POST["verse"]);
            $content = htmlspecialchars($_POST["content"]);

            echo("$book $chapter:$verse &ldquo;$content&rdquo;");
        ?>
    </body>
</html>