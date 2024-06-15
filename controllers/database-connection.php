<?php
include 'config.php';

$conn = "";
try {
    $dsn = "mysql:host=" . $BBDD_HOST . ";dbname=" . $BBDD_NAME . ";charset=utf8";

    echo $dsn;
    echo $BBDD_PASSWORD;
    echo $BBDD_USER;
    $conn = new PDO($dsn, $BBDD_USER, $BBDD_PASSWORD);

    echo $conn;
} catch (PDOException $e) {

    echo "TEST";
    die("Error: " . $e->getMessage() . "<br>");
}



return  $conn;