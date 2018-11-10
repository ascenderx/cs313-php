<?php
    /**
     * DATABASE CONNECT
     * This initializes a database connection that can be accessed via the
     * $db variable.
     */
    try {
        $dbUrl = getenv('DATABASE_URL');
        
        $dbOpts = parse_url($dbUrl);
        
        $dbHost = $dbOpts["host"];
        $dbPort = $dbOpts["port"];
        $dbUser = $dbOpts["user"];
        $dbPassword = $dbOpts["pass"];
        $dbName = "team07";

        $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $ex) {
        $msg = $ex->getMessage();
        echo "Error!: $msg";
        die();
    }
?>