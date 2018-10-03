<?php
    $name       = htmlspecialchars($_POST["name"]);
    $email      = htmlspecialchars($_POST["email"]);
    $major      = htmlspecialchars($_POST["major"]);
    $comments   = htmlspecialchars($_POST["comments"]);
    $continents = htmlspecialchars($_POST["continents"]);
?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Wazzap</title>
        <meta charset="UTF-8"/>
    </head>
    <body>

    Username: <?php echo $name; ?><br/>
    E-mail: <?php echo "mailto:" . $email; ?><br/>
    Major: 
    <?php
    if (isset($major)) {
        echo $major;
    }
    ?>
    <br/>
    Comments: <br/>
    <?php
    if (isset($comments)) {
        echo $comments;
    }
    ?><br/>
    Continents: <br/>
    <?php
        $map = array("North America", "South America", "Europe", "Asia", "Australia", "Africa", "Antartica");
        if (!empty($continents)) {
            foreach ($continents as $cont) {
                echo $map[$cont] . "<br/>";
            }
        }
    ?>
    </body>
</html>