<?php
require_once '../includes/security.php';
require_once '../config/db.php';

if (!isset($_SESSION['usuario'])) {
    header('Location: ../auth/login.php');
    exit();
}

// Obtener estadísticas.
$stmt_prod = $pdo->query("SELECT COUNT(*) FROM productos");
$total_productos = $stmt_prod->fetchColumn();

$stmt_cat = $pdo->query("SELECT COUNT(*) FROM categorias");
$total_categorias = $stmt_cat->fetchColumn();

$stmt_stock = $pdo->query("SELECT COUNT(*) FROM productos WHERE stock < 5");
$productos_bajo_stock = $stmt_stock->fetchColumn();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Inventario de Motos</title>
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<body>
    <div class="admin-header">
        <h1>Panel de Administración</h1>
        <nav>
            <a href="categorias/listar.php">Categorías</a>
            <a href="productos/listar.php">Motos</a>
            <a href="../auth/logout.php">Cerrar Sesión</a>
        </nav>
    </div>

    <div class="container">
        <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?></h2>
        
        <div class="dashboard-cards">
            <div class="card">
                <h3>Total de Motos</h3>
                <p><?php echo htmlspecialchars($total_productos); ?></p>
            </div>
            <div class="card">
                <h3>Total de Categorías</h3>
                <p><?php echo htmlspecialchars($total_categorias); ?></p>
            </div>
            <div class="card">
                <h3>Motos con Bajo Stock</h3>
                <p><?php echo htmlspecialchars($productos_bajo_stock); ?></p>
            </div>
        </div>

        <div style="margin-top: 40px; display: flex; flex-direction: column; gap: 20px; align-items: center;">
            <a href="productos/listar.php" class="btn btn-primary" style="padding: 15px 40px; font-size: 1.2em; width: 100%; max-width: 500px; text-align: center;">Gestionar y Editar Motos</a>
            <a href="../productos.php" class="btn btn-success" style="padding: 15px 40px; font-size: 1.2em; width: 100%; max-width: 500px; text-align: center;" target="_blank">Ver Catálogo Público</a>
        </div>
    </div>
    <?php require '../includes/footer.php'; ?>
</body>
</html>
