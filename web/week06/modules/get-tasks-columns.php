<?php
    session_start();

    require("./redirects.php");
    require('./dbconnect.php');

    $user = $_SESSION["user"];
    if (!isset($user)) {
        loginRedirect();
    }

    // var_dump($_POST);
    // var_dump($_GET);
    // exit;

    $cols = array();
    try {
        // get the columns in the table
        $queryString = "SELECT column_name FROM information_schema.columns WHERE table_name = 'tasks';";
        foreach ($db->query($queryString) as $row) {
            array_push($cols, $row['column_name']);
        }
    } catch (PDOException $ex) {
        header("HTTP/1.0 409 Conflict");
        $msg = $ex->getMessage();
        $trc = $ex->getTraceAsString();
        echo("$msg\n$trc\n");
        exit;
    }

    $json = json_encode($cols);
    header("HTTP/1.0 200 Success");
    echo($json);
    exit;
?>