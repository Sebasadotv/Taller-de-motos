<?php
require_once '../../includes/security.php';
require_once '../../config/db.php';

require_login('../../auth/login.php');

$id = validate_id(get_input('id'));

if (!$id) {
    redirect('listar.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify CSRF token.
    verify_csrf_or_redirect('listar.php');
    $nombre = post_input('nombre');
    
    if (!empty($nombre)) {
        $stmt = $pdo->prepare("UPDATE categorias SET nombre = ? WHERE id = ?");
        $stmt->execute([$nombre, $id]);
        redirect('listar.php');
    }
}

$stmt = $pdo->prepare("SELECT * FROM categorias WHERE id = ?");
$stmt->execute([$id]);
$categoria = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$categoria) {
    redirect('listar.php');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Categoría - Inventario de Motos</title>
    <link rel="stylesheet" href="../../assets/css/estilos.css">
</head>
<body>
    <div class="admin-header">
        <h1>Editar Categoría</h1>
        <nav>
            <a href="../index.php">Dashboard</a>
            <a href="listar.php">Categorías</a>
            <a href="../../auth/logout.php">Cerrar Sesión</a>
        </nav>
    </div>

    <div class="container">
        <div class="form-container">
            <h2>Editar Categoría</h2>
            <form method="POST">
                <?php echo csrf_field(); ?>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Nombre de la Categoría:</label>
                        <input type="text" name="nombre" value="<?php echo htmlspecialchars($categoria['nombre']); ?>" required>
                    </div>
                </div>
                <div class="form-actions">
                    <a href="listar.php" class="btn btn-danger">Cancelar</a>
                    <button type="submit" class="btn btn-success">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
    <?php require '../../includes/footer.php'; ?>
</body>
</html>
