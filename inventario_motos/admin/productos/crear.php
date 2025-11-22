<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../../auth/login.php');
    exit();
}

require_once '../../config/db.php';
require_once '../../includes/security.php';

// Obtener categorías para el select.
$stmt_cat = $pdo->query("SELECT * FROM categorias ORDER BY nombre");
$categorias = $stmt_cat->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify CSRF token
    verify_csrf_or_redirect('crear.php');
    
    $nombre = post_input('nombre');
    $cilindrada = post_input('cilindrada');
    $color = post_input('color');
    $precio = post_input('precio', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $stock = post_input('stock', FILTER_SANITIZE_NUMBER_INT);
    $categoria_id = validate_id(post_input('categoria_id', FILTER_SANITIZE_NUMBER_INT));
    $imagen = post_input('imagen', FILTER_SANITIZE_URL, '');

    $stmt = $pdo->prepare(
        "INSERT INTO productos (nombre, cilindrada, color, precio, stock, categoria_id, imagen) VALUES (?, ?, ?, ?, ?, ?, ?)"
    );
    $stmt->execute([$nombre, $cilindrada, $color, $precio, $stock, $categoria_id, $imagen]);
    
    header('Location: listar.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Moto - Inventario de Motos</title>
    <link rel="stylesheet" href="../../assets/css/estilos.css">
</head>
<body>
    <div class="admin-header">
        <h1>Crear Moto</h1>
        <nav>
            <a href="../index.php">Dashboard</a>
            <a href="listar.php">Motos</a>
            <a href="../../auth/logout.php">Cerrar Sesión</a>
        </nav>
    </div>

    <div class="container">
        <div class="form-container">
            <h2>Nueva Moto</h2>
            <form method="POST">
                <?php echo csrf_field(); ?>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Nombre de la Moto:</label>
                        <input type="text" name="nombre" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Cilindrada (ej: 250cc, 1000cc):</label>
                        <input type="text" name="cilindrada" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Color:</label>
                        <input type="text" name="color" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Precio:</label>
                        <input type="number" name="precio" step="0.01" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Stock:</label>
                        <input type="number" name="stock" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Categoría:</label>
                        <select name="categoria_id" required>
                            <option value="">Seleccione una categoría</option>
                            <?php foreach ($categorias as $categoria) : ?>
                                <option value="<?php echo $categoria['id']; ?>">
                                    <?php echo htmlspecialchars($categoria['nombre']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>URL de Imagen (opcional):</label>
                        <input type="text" name="imagen">
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
