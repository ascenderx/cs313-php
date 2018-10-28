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

    $task = $_POST["task-id"];
    if (!isset($task)) {
        header("HTTP/1.0 406 Not Acceptable");
        echo("No task specified");
        exit;
    }
    $task = htmlspecialchars(trim($task));

    try {
        // send an delete query
        $stmt = $db->prepare("DELETE FROM tasks WHERE id = :taskid;");
        $stmt->execute(array(":taskid" => $task));
    } catch (PDOException $ex) {
        header("HTTP/1.0 409 Conflict");
        $msg = $ex->getMessage();
        $trc = $ex->getTraceAsString();
        echo("$msg\n$trc\n");
        echo("task: $task\n");
        exit;
    }

    header("HTTP/1.0 200 Success");
    echo("Update successful");
    exit;
?>