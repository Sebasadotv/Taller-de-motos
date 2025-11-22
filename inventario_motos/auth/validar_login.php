<?php
require_once '../includes/security.php';

verify_csrf_or_redirect('login.php');

$usuario = post_input('usuario');
$password = post_input('password', FILTER_DEFAULT);

if ($usuario === 'admin' && $password === 'admin') {
    $_SESSION['usuario'] = $usuario;
    header('Location: ../admin/index.php');
} else {
    header('Location: login.php');
}

exit();
