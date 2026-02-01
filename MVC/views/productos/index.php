<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Productos</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn { padding: 5px 10px; text-decoration: none; border-radius: 3px; }
        .btn-add { background-color: #28a745; color: white; margin-bottom: 10px; display: inline-block; }
        .btn-edit { background-color: #ffc107; color: black; }
        .btn-delete { background-color: #dc3545; color: white; }
    </style>
</head>
<body>

    <h1>Gestión de Productos</h1>

    <a href="index.php?controller=producto&action=create" class="btn btn-add">Crear Nuevo Producto</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($productos)): ?>
                <?php foreach ($productos as $p): ?>
                <tr>
                    <td><?php echo $p['id']; ?></td>
                    <td><?php echo $p['nombre']; ?></td>
                    <td><?php echo $p['descripcion']; ?></td>
                    <td>$<?php echo number_format($p['precio'], 2); ?></td>
                    <td><?php echo $p['stock']; ?></td>
                    <td>
                        <a href="index.php?controller=producto&action=edit&id=<?php echo $p['id']; ?>" class="btn btn-edit">Editar</a>
                        
                        <a href="#" onclick="confirmarEliminar(<?php echo $p['id']; ?>)" class="btn btn-delete">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No hay productos registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <script>
        function confirmarEliminar(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
                window.location.href = 'index.php?controller=producto&action=delete&id=' + id;
            }
        }
    </script>

</body>
</html>