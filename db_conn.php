<?php

    require_once './includes/db_config.php';

    //connect to db
    try{
        $conn = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.'',DB_USER,DB_PASSWD);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->exec('SET NAMES "utf8"');

    }catch(PDOException $e){
//        $output = 'Fail to connect to the database. Error: '. $e->getMessage();
//        include 'output.php';
        echo "DB Connection failed: " . $e->getMessage();
        exit();
    }

?>