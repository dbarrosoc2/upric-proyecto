<?php
require __DIR__ .'/config.php';

$conn = "test";
try {
    $dsn = "mysql:host=" . $BBDD_HOST . ";dbname=" . $BBDD_NAME . ";charset=utf8";
    $conn = new PDO($dsn, $BBDD_USER, $BBDD_PASSWORD);
} catch (PDOException $e) {

    echo "ERRORRRRRRRR"
    die("Error: " . $e->getMessage() . "<br>");
}

return  $conn;