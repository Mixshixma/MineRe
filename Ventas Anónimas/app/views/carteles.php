<?php
// 1. Capturamos los tres filtros de la URL
$filtro_pais = isset($_GET['f_pais']) ? $_GET['f_pais'] : null;
$filtro_cat  = isset($_GET['f_cat'])  ? $_GET['f_cat']  : null;
$filtro_est  = isset($_GET['f_est'])  ? $_GET['f_est']  : null;

$stmt = $anuncio->read($filtro_pais, $filtro_cat, $filtro_est);
$num = $stmt->rowCount();

$paises = ["Argentina", "Bolivia", "Chile", "Colombia", "Costa Rica", "Cuba", "Ecuador", "El Salvador", "España", "Guatemala", "Honduras", "México", "Nicaragua", "Panamá", "Paraguay", "Perú", "Puerto Rico", "República Dominicana", "Uruguay", "Venezuela"];
$categorias = ['Tecnología', 'Hogar', 'Moda', 'Salud', 'Hobby', 'Otros'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carteles - Ventas Anónimas</title>
    <style>
        .badge-category { position: absolute; top: 10px; right: 10px; z-index: 10; }
        .price-tag { font-size: 1.25rem; font-weight: bold; color: #198754; }
        .card-custom { border-radius: 15px; overflow: hidden; }
        /* Ajuste para que los select se vean bien en fondo blanco */
        .form-select-custom { border: 1px solid #dee2e6 !important; }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <h1>Carteles del Momento</h1>
        </div>

        <div class="card shadow-sm mb-5 bg-white p-4" style="border-radius: 15px; border: none;">
            <form method="GET" action="index.php" class="row g-3 align-items-end">
                <input type="hidden" name="p" value="carteles">

                <div class="col-md-4">
                    <label class="small text-uppercase fw-bold text-secondary mb-2">País</label>
                    <select name="f_pais" class="form-select form-select-custom">
                        <option value="">Todos los países</option>
                        <?php foreach($paises as $p): ?>
                            <option value="<?php echo $p; ?>" <?php echo ($filtro_pais == $p) ? 'selected' : ''; ?>><?php echo $p; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="small text-uppercase fw-bold text-secondary mb-2">Categoría</label>
                    <select name="f_cat" class="form-select form-select-custom">
                        <option value="">Todas las categorías</option>
                        <?php foreach($categorias as $c): ?>
                            <option value="<?php echo $c; ?>" <?php echo ($filtro_cat == $c) ? 'selected' : ''; ?>><?php echo $c; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="small text-uppercase fw-bold text-secondary mb-2">Estado</label>
                    <select name="f_est" class="form-select form-select-custom">
                        <option value="">Cualquiera</option>
                        <option value="Nuevo" <?php echo ($filtro_est == 'Nuevo') ? 'selected' : ''; ?>>Nuevo</option>
                        <option value="Usado" <?php echo ($filtro_est == 'Usado') ? 'selected' : ''; ?>>Usado</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100 fw-bold">🔍 Buscar</button>
                </div>
                
                </form>
            
            <?php if($filtro_pais || $filtro_cat || $filtro_est): ?>
                <div class="text-center mt-3">
                    <a href="index.php?p=carteles" class="text-muted small text-decoration-none">✕ Limpiar todos los filtros</a>
                </div>
            <?php endif; ?>
        </div>

        <?php if($num > 0): ?>
            <p class="text-muted">Mostrando <strong><?php echo $num; ?></strong> resultados.</p>
            <div class="row">
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm border-0 card-custom">
                            <span class="badge bg-primary badge-category">
                                <?php echo htmlspecialchars($row['categoria']); ?>
                            </span>

                            <?php if(!empty($row['imagen_url'])): ?>
                                <img src="<?php echo htmlspecialchars($row['imagen_url']); ?>" 
                                    class="card-img-top" 
                                    alt="Foto" 
                                    style="height: 200px; object-fit: contain; background-color: #f8f9fa;"> 
                            <?php else: ?>
                                <img src="https://via.placeholder.com/300x200?text=Sin+Foto" 
                                    class="card-img-top" 
                                    alt="Sin imagen" 
                                    style="height: 200px; object-fit: cover;">
                            <?php endif; ?>

                            <div class="card-body">
                                <h5 class="card-title text-dark mb-1"><?php echo htmlspecialchars($row['titulo']); ?></h5>
                                <div class="mb-2">
                                    <span class="price-tag">$<?php echo number_format($row['precio'], 2); ?></span>
                                    <span class="badge bg-light text-dark border"><?php echo htmlspecialchars($row['estado']); ?></span>
                                </div>
                                <p class="card-text text-secondary small">
                                    <?php echo nl2br(htmlspecialchars(substr($row['descripcion'], 0, 100))); ?>...
                                </p>
                                <p class="small mb-0">
                                    📍 <strong>País:</strong> <?php echo htmlspecialchars($row['pais']); ?>
                                </p>
                            </div>
                            
                            <div class="card-footer bg-transparent border-top-0 pb-3">
                                <div class="p-2 bg-light rounded mb-3">
                                    <small class="text-muted d-block text-truncate">
                                        <b>Contacto:</b> <?php echo htmlspecialchars($row['contacto']); ?>
                                    </small>
                                </div>
                                <div class="btn-group w-100">
                                    <a href="index.php?p=editar&id=<?php echo $row['id']; ?>" class="btn btn-outline-warning btn-sm">Editar</a>
                                    <button onclick="borrarConToken(<?php echo $row['id']; ?>)" class="btn btn-outline-danger btn-sm">Eliminar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center border-0 shadow-sm">No hay anuncios que coincidan con tu búsqueda.</div>
        <?php endif; ?>
    </div>

    <script>
    function borrarConToken(id) {
        let token = prompt("Introduce el código de seguridad para borrar este anuncio:");
        if (token) {
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = '../app/controllers/AnuncioController.php?action=eliminar';
            form.innerHTML = `
                <input type="hidden" name="id" value="${id}">
                <input type="hidden" name="token" value="${token}">
            `;
            document.body.appendChild(form);
            form.submit();
        }
    }
    </script>
</body>
</html>