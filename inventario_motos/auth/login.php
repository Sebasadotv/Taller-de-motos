<?php require_once '../includes/security.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Inventario de Motos</title>
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <form action="validar_login.php" method="POST">
            <?php echo csrf_field(); ?>
            <input type="text" name="usuario" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Ingresar</button>
        </form>
    </div>
    <?php require '../includes/footer.php'; ?>
</body>
</html>
