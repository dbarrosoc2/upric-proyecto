<?php
require 'config.php';

try {
    $dsn = "mysql:host=" . $BBDD_HOST . ";dbname=" . $BBDD_NAME . ";charset=utf8";
    $conn = new PDO($dsn, $BBDD_USER, $BBDD_PASSWORD);
} catch (PDOException $e) {
    echo "ERROR";
    die("Error: " . $e->getMessage() . "<br>");
}

return  $conn;