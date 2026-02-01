<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <style>
        .error-box { background: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 15px; border: 1px solid #f5c6cb; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; }
        input, textarea { width: 300px; padding: 5px; }
        .btn-update { background: #ffc107; color: black; padding: 10px 20px; border: none; cursor: pointer; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Editar Producto</h1>

    <?php if (!empty($errores)): ?>
        <div class="error-box">
            <ul>
                <?php foreach ($errores as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="index.php?controller=producto&action=update" method="POST">
        <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">

        <div class="form-group">
            <label>Nombre:</label>
            <input type="text" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required>
        </div>

        <div class="form-group">
            <label>Descripción:</label>
            <textarea name="descripcion"><?php echo htmlspecialchars($producto['descripcion']); ?></textarea>
        </div>

        <div class="form-group">
            <label>Precio:</label>
            <input type="number" step="0.01" name="precio" value="<?php echo $producto['precio']; ?>" required>
        </div>

        <div class="form-group">
            <label>Stock:</label>
            <input type="number" name="stock" value="<?php echo $producto['stock']; ?>" required>
        </div>

        <button type="submit" class="btn-update">Actualizar Cambios</button>
        <a href="index.php?controller=producto&action=index">Cancelar</a>
    </form>
</body>
</html>