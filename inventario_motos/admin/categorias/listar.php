<?php
require_once '../../includes/security.php';
require_once '../../config/db.php';

if (!isset($_SESSION['usuario'])) {
    header('Location: ../../auth/login.php');
    exit();
}

$stmt = $pdo->query("SELECT * FROM categorias ORDER BY nombre");
$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Categorías - Inventario de Motos</title>
    <link rel="stylesheet" href="../../assets/css/estilos.css">
</head>
<body>
    <div class="admin-header">
        <h1>Gestión de Categorías</h1>
        <nav>
            <a href="../index.php">Dashboard</a>
            <a href="../productos/listar.php">Motos</a>
            <a href="../../auth/logout.php">Cerrar Sesión</a>
        </nav>
    </div>

    <div class="container">
        <div class="card-container">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
                <h2>Lista de Categorías</h2>
                <a href="crear.php" class="btn btn-primary">Nueva Categoría</a>
            </div>

            <div class="scrollable-table">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categorias as $categoria) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($categoria['id']); ?></td>
                                <td><?php echo htmlspecialchars($categoria['nombre']); ?></td>
                                <td>
                                    <a href="editar.php?id=<?php echo htmlspecialchars($categoria['id']); ?>" class="btn btn-warning">Editar</a>
                                    <a href="eliminar.php?id=<?php echo htmlspecialchars($categoria['id']); ?>&<?php echo csrf_param(); ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta categoría?')">Eliminar</a>
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
