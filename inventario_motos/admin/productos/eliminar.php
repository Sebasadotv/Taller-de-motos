<?php
require_once '../../includes/security.php';
require_once '../../config/db.php';

require_login('../../auth/login.php');

$id = validate_id(get_input('id'));

// Verify CSRF token.
verify_csrf_or_redirect('listar.php');

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM productos WHERE id = ?");
    $stmt->execute([$id]);
}

redirect('listar.php');
