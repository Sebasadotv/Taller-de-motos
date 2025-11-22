<?php
session_start();
$usuario = $_POST['usuario'] ?? '';
$password = $_POST['password'] ?? '';

if ($usuario === 'admin' && $password === 'admin') {
    $_SESSION['usuario'] = $usuario;
    header('Location: ../admin/index.php');
} else {
    header('Location: login.php');
}
exit();
?>
