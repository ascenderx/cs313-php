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

    // check for assingment id
    $assign = $_POST["assign-id"];
    if (!isset($assign)) {
        header("HTTP/1.0 406 Not Acceptable");
        echo("No assignment specified");
        exit;
    }

    // sanitize input
    $data = array();
    foreach ($_POST as $key => $value) {
        $data[$key] = htmlspecialchars(trim($value));
    }

    // convert assign-id from PHP to assignment for SQL
    $data["assignment"] = $data["assign-id"];
    unset($data["assign-id"]);

    try {
        // get the columns in the table
        $queryString = "SELECT column_name FROM information_schema.columns WHERE table_name = 'tasks';";
        // try and match the $_POST column names to avoid SQL injection
        $dbCols = $db->query($queryString);
        foreach ($data as $key => $value) {
            $valid = false;
            foreach ($dbCols as $col) {
                if ($col["column_name"] == $key) {
                    $valid = true;
                    break;
                }
            }
            // if there is an invalid column, then remove it
            if (!$valid) {
                unset($data[$key]);
            }
        }

        // separate keys from values for query string creation
        $keys = implode(',', array_keys($data));
        $values = array_values($data);
        // convert into ":1", ":2", ":3", etc. form
        foreach ($values as $key => $value) {
            $values[":$key"] = $value;
            unset($values[$key]);
        }
        $newVals = implode(',', array_keys($values));

        // send an insert query
        $queryString = "INSERT INTO tasks ($keys) VALUES ($newVals);";
        $stmt = $db->prepare($queryString);
        $stmt->execute($values);
    } catch (PDOException $ex) {
        header("HTTP/1.0 409 Conflict");
        $msg = $ex->getMessage();
        $trc = $ex->getTraceAsString();
        echo("$msg\n$trc\n");
        exit;
    }

    header("HTTP/1.0 200 Success");
    echo("Update successful");
    exit;
?>