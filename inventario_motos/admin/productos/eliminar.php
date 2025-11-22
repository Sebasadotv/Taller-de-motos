<?php
require_once '../../includes/security.php';
if (!isset($_SESSION['usuario'])) {
    header('Location: ../../auth/login.php');
    exit();
}

require_once '../../config/db.php';
require_once '../../includes/security.php';

$id = validate_id(get_input('id'));

// Verify CSRF token.
verify_csrf_or_redirect('listar.php');

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM productos WHERE id = ?");
    $stmt->execute([$id]);
}

header('Location: listar.php');
exit();
