<?php
    $servername = "localhost";
    $db_name = "pracphp";
    $username = "root";
    $password = "Cordova022201";
    try {
        $conn = new PDO("mysql:host=$servername; dbname=$db_name", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection Failed". $e->getMessage();
    }
?>