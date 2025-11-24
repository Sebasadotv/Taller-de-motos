<?php
$host = 'localhost';
$dbname = 'inventario_motos_db';
$username = 'root';
$password = '1234';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log("Error de conexión: ". $e->getMessage());
    die("Error de conexión a la base de datos. Por favor, intente más tarde.");
}
