<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../../auth/login.php');
    exit();
}
require_once '../../config/db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: listar.php');
    exit();
}

// Obtener categorías para el select
$stmt_cat = $pdo->query("SELECT * FROM categorias ORDER BY nombre");
$categorias = $stmt_cat->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $cilindrada = $_POST['cilindrada'];
    $color = $_POST['color'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $categoria_id = $_POST['categoria_id'];
    $imagen = $_POST['imagen'] ?? '';
    
    $stmt = $pdo->prepare("UPDATE productos SET nombre = ?, cilindrada = ?, color = ?, precio = ?, stock = ?, categoria_id = ?, imagen = ? WHERE id = ?");
    $stmt->execute([$nombre, $cilindrada, $color, $precio, $stock, $categoria_id, $imagen, $id]);
    
    header('Location: listar.php');
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM productos WHERE id = ?");
$stmt->execute([$id]);
$producto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$producto) {
    header('Location: listar.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Moto - Inventario de Motos</title>
    <link rel="stylesheet" href="../../assets/css/estilos.css">
</head>
<body>
    <div class="admin-header">
        <h1>Editar Moto</h1>
        <nav>
            <a href="../index.php">Dashboard</a>
            <a href="listar.php">Motos</a>
            <a href="../../auth/logout.php">Cerrar Sesión</a>
        </nav>
    </div>

    <div class="container">
        <div class="form-container">
            <h2>Editar Moto</h2>
            <form method="POST">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Nombre de la Moto:</label>
                        <input type="text" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Cilindrada (ej: 250cc, 1000cc):</label>
                        <input type="text" name="cilindrada" value="<?php echo htmlspecialchars($producto['cilindrada']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Color:</label>
                        <input type="text" name="color" value="<?php echo htmlspecialchars($producto['color']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Precio:</label>
                        <input type="number" name="precio" step="0.01" value="<?php echo $producto['precio']; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Stock:</label>
                        <input type="number" name="stock" value="<?php echo $producto['stock']; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Categoría:</label>
                        <select name="categoria_id" required>
                            <?php foreach ($categorias as $categoria): ?>
                                <option value="<?php echo $categoria['id']; ?>" 
                                        <?php echo $producto['categoria_id'] == $categoria['id'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($categoria['nombre']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>URL de Imagen (opcional):</label>
                        <input type="text" name="imagen" value="<?php echo htmlspecialchars($producto['imagen']); ?>">
                    </div>
                </div>
                
                <div class="form-actions">
                    <a href="listar.php" class="btn btn-danger">Cancelar</a>
                    <button type="submit" class="btn btn-success">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
    <?php include '../../includes/footer.php'; ?>
</body>
</html>
