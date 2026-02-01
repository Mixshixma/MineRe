<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Producto</title>
    <style>
        .error-box { background: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 15px; border: 1px solid #f5c6cb; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; }
        input, text-area { width: 300px; padding: 5px; }
        .btn-save { background: #28a745; color: white; padding: 10px 20px; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Nuevo Producto</h1>

    <?php if (!empty($errores)): ?>
        <div class="error-box">
            <ul>
                <?php foreach ($errores as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="index.php?controller=producto&action=store" method="POST">
        <div class="form-group">
            <label>Nombre (mínimo 3 caracteres):</label>
            <input type="text" name="nombre" value="<?php echo $_POST['nombre'] ?? ''; ?>" required>
        </div>

        <div class="form-group">
            <label>Descripción:</label>
            <textarea name="descripcion"><?php echo $_POST['descripcion'] ?? ''; ?></textarea>
        </div>

        <div class="form-group">
            <label>Precio (mayor a 0):</label>
            <input type="number" step="0.01" name="precio" value="<?php echo $_POST['precio'] ?? ''; ?>" required>
        </div>

        <div class="form-group">
            <label>Stock (entero no negativo):</label>
            <input type="number" name="stock" value="<?php echo $_POST['stock'] ?? '0'; ?>" required>
        </div>

        <button type="submit" class="btn-save">Guardar Producto</button>
        <a href="index.php?controller=producto&action=index">Cancelar</a>
    </form>
</body>
</html>