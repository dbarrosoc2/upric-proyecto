<?php
include 'config.php';

$conn = "";
try {
    $dsn = "mysql:host=" . $BBDD_HOST . ";dbname=" . $BBDD_NAME . ";charset=utf8";
    $conn = new PDO($dsn, $BBDD_USER, $BBDD_PASSWORD);

    echo $conn;
    echo "<br>";
    echo $dsn;
} catch (PDOException $e) {

    echo "TEST";
    die("Error: " . $e->getMessage() . "<br>");
}

return  $conn;