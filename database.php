<?php

$dsn = 'mysql:host=localhost;dbname=recipe_manager';
$username = 'root';
$password = '';

try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    include('database_error.php');
    exit();
}

?>