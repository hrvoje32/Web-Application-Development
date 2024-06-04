<?php

$config = require 'config.php';

// Extract the database configuration from $config
$dbConfig = $config['mysql'];

// Create a new mysqli connection
$con = new mysqli($dbConfig['host'], $dbConfig['user'], $dbConfig['pass'], $dbConfig['name']);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

?>
