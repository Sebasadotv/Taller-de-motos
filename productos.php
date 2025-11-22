<?php
require_once 'config/db.php';

// Obtener todas las categorías para el filtro
$stmt_cat = $pdo->query("SELECT * FROM categorias ORDER BY nombre");
$categorias = $stmt_cat->fetchAll(PDO::FETCH_ASSOC);

// Filtrar por categoría si se selecciona
$categoria_id = $_GET['categoria'] ?? null;

if ($categoria_id) {
    $stmt = $pdo->prepare("SELECT p.*, c.nombre as categoria_nombre FROM productos p 
                          INNER JOIN categorias c ON p.categoria_id = c.id 
                          WHERE p.categoria_id = ? ORDER BY p.nombre");
    $stmt->execute([$categoria_id]);
} else {
    $stmt = $pdo->query("SELECT p.*, c.nombre as categoria_nombre FROM productos p 
                        INNER JOIN categorias c ON p.categoria_id = c.id 
                        ORDER BY p.nombre");
}

$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Motos - Inventario de Motos</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>
    <div class="hero" style="padding: 60px 40px;">
        <h1 style="font-size: 2.5rem;">Catálogo de Motos</h1>
        <p style="font-size: 1.1rem;">Explora nuestra colección de motocicletas</p>
        <div class="hero-buttons">
            <a href="index.php" class="btn btn-success">Volver al Inicio</a>
            <a href="auth/login.php" class="btn btn-primary">Administrar</a>
        </div>
    </div>

    <div class="container">
        <div style="margin-bottom: 30px; text-align: center;">
            <h3>Filtrar por Categoría:</h3>
            <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; margin-top: 15px;">
                <a href="productos.php" class="btn <?php echo !$categoria_id ? 'btn-primary' : 'btn-warning'; ?>">Todas</a>
                <?php foreach ($categorias as $cat): ?>
                    <a href="productos.php?categoria=<?php echo $cat['id']; ?>" 
                       class="btn <?php echo $categoria_id == $cat['id'] ? 'btn-primary' : 'btn-warning'; ?>">
                        <?php echo htmlspecialchars($cat['nombre']); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <?php if (count($productos) > 0): ?>
            <div class="product-grid">
                <?php foreach ($productos as $producto): ?>
                    <div class="product-card">
                        <img src="<?php echo $producto['imagen'] ?: 'assets/img/productos/default-moto.jpg'; ?>" 
                             alt="<?php echo htmlspecialchars($producto['nombre']); ?>" 
                             class="product-image"
                             onerror="this.src='https://via.placeholder.com/400x280/2d3142/ff6b35?text=Moto'">
                        <div class="product-info">
                            <div class="product-category"><?php echo htmlspecialchars($producto['categoria_nombre']); ?></div>
                            <h3><?php echo htmlspecialchars($producto['nombre']); ?></h3>
                            <p style="color: var(--text-secondary); margin: 10px 0;">
                                <strong>Cilindrada:</strong> <?php echo htmlspecialchars($producto['cilindrada']); ?><br>
                                <strong>Color:</strong> <?php echo htmlspecialchars($producto['color']); ?><br>
                                <strong>Stock:</strong> <?php echo $producto['stock']; ?> unidades
                            </p>
                            <div class="product-price">$<?php echo number_format($producto['precio'], 0, ',', '.'); ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="no-products">
                No hay motos disponibles en esta categoría.
            </div>
        <?php endif; ?>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
