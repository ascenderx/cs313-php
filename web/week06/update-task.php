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
    $column = $_POST["column"];
    $value = $_POST["value"];
    if (!isset($task) || !isset($column)) {
        header("HTTP/1.0 406 Not Acceptable");
        echo("No task and/or column specified");
        exit;
    }

    $task = htmlspecialchars(trim($task));
    $column = htmlspecialchars(trim($column));
    $value = htmlspecialchars(trim($value));

    try {
        // get the columns in the table
        $queryString = "SELECT column_name FROM information_schema.columns WHERE table_name = 'tasks';";
        $correctCol = false;
        // try and match the $_POST column name to avoid SQL injection
        foreach ($db->query($queryString) as $row) {
            if ($row["column_name"] == $column) {
                $correctCol = true;
                break;
            }
        }
        // if column is invalid, then end
        if (!$correctCol) {
            throw new PDOException("Invalid column \"$column\"");
        }

        // send an update query
        $stmt = $db->prepare("UPDATE tasks SET $column = :value WHERE id = :taskid;");
        $stmt->execute(array(
            ":value" => $value,
            ":taskid" => $task,
        ));
    } catch (PDOException $ex) {
        header("HTTP/1.0 409 Conflict");
        $msg = $ex->getMessage();
        $trc = $ex->getTraceAsString();
        echo("$msg\n$trc\n");
        echo("task: $task\n");
        echo("column: $column\n");
        echo("value: $value\n");
        exit;
    }

    header("HTTP/1.0 200 Success");
    echo("Update successful");
    exit;
?>