<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../../auth/login.php');
    exit();
}

require_once '../../config/db.php';

$stmt = $pdo->query(
    "SELECT p.*, c.nombre as categoria_nombre FROM productos p INNER JOIN categorias c ON p.categoria_id = c.id ORDER BY p.nombre"
);
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Motos - Inventario de Motos</title>
    <link rel="stylesheet" href="../../assets/css/estilos.css">
</head>
<body>
    <div class="admin-header">
        <h1>Gestión de Motos</h1>
        <nav>
            <a href="../index.php">Dashboard</a>
            <a href="../categorias/listar.php">Categorías</a>
            <a href="../../auth/logout.php">Cerrar Sesión</a>
        </nav>
    </div>

    <div class="container">
        <div class="card-container">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
                <h2>Lista de Motos</h2>
                <a href="crear.php" class="btn btn-primary">Nueva Moto</a>
            </div>

            <div class="scrollable-table">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Cilindrada</th>
                            <th>Color</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Categoría</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos as $producto) : ?>
                            <tr>
                                <td><?php echo $producto['id']; ?></td>
                                <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($producto['cilindrada']); ?></td>
                                <td><?php echo htmlspecialchars($producto['color']); ?></td>
                                <td>$<?php echo number_format($producto['precio'], 0, ',', '.'); ?></td>
                                <td><?php echo $producto['stock']; ?></td>
                                <td><?php echo htmlspecialchars($producto['categoria_nombre']); ?></td>
                                <td>
                                    <a href="editar.php?id=<?php echo $producto['id']; ?>" class="btn btn-warning">Editar</a>
                                    <a href="eliminar.php?id=<?php echo $producto['id']; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta moto?')">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php require '../../includes/footer.php'; ?>
</body>
</html>
