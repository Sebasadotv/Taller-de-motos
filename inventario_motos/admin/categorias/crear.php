<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../../auth/login.php');
    exit();
}

require_once '../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $stmt = $pdo->prepare("INSERT INTO categorias (nombre) VALUES (?)");
    $stmt->execute([$nombre]);
    
    header('Location: listar.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Categoría - Inventario de Motos</title>
    <link rel="stylesheet" href="../../assets/css/estilos.css">
</head>
<body>
    <div class="admin-header">
        <h1>Crear Categoría</h1>
        <nav>
            <a href="../index.php">Dashboard</a>
            <a href="listar.php">Categorías</a>
            <a href="../../auth/logout.php">Cerrar Sesión</a>
        </nav>
    </div>

    <div class="container">
        <div class="form-container">
            <h2>Nueva Categoría</h2>
            <form method="POST">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Nombre de la Categoría:</label>
                        <input type="text" name="nombre" required>
                    </div>
                </div>
                <div class="form-actions">
                    <a href="listar.php" class="btn btn-danger">Cancelar</a>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
    <?php require '../../includes/footer.php'; ?>
</body>
</html>
