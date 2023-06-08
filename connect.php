<?php 

$host = '127.0.0.1';
$db = 'chatapp';
$user = 'bit_academy';
$pass = 'bit_academy';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$pdo = new PDO($dsn, $user, $pass);