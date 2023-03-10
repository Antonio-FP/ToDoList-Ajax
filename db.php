<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$host = getenv('BBDD_HOST');
$user = getenv('BBDD_USER');
$pass = getenv('BBDD_PASS');
$database = getenv('BBDD_DB');


$pdo = new PDO("mysql:host=localhost;dbname=todolist;charset=utf8", "root", "");
?>
