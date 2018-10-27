<?php
    session_start();

    require("./modules/redirects.php");
    require('./modules/dbconnect.php');

    $user = $_SESSION["user"];
    if (!isset($user)) {
        loginRedirect();
    }

    // var_dump($_POST);
    // var_dump($_GET);
    // exit;

    $assign = $_GET["assign-id"];
    if (!isset($assign)) {
        header("HTTP/1.0 406 Not Acceptable");
        echo("No assignment specified");
        exit;
    }

    $assign = htmlspecialchars(trim($assign));
    
    $stmt = $db->prepare("SELECT * FROM tasks WHERE assignment=:assign");
    $stmt->execute(array(":assign" => $assign));
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($rows) > 0) {
        header("HTTP/1.0 200 Success");
        echo(json_encode($rows));
        exit;
    } else {
        header("HTTP/1.0 204 No Content");
        echo("Empty");
        exit;
    }
?>