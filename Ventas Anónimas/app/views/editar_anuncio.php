<?php
// Suponiendo que $db y $anuncio ya vienen del index.php
$id = isset($_GET['id']) ? $_GET['id'] : die('Error: ID no encontrado.');
$query = "SELECT * FROM anuncios WHERE id = :id";
$stmt = $db->prepare($query);
$stmt->bindParam(":id", $id);
$stmt->execute();
$anuncio_actual = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$anuncio_actual) die('El anuncio no existe.');

$paises = ["Argentina", "Bolivia", "Chile", "Colombia", "Costa Rica", "Cuba", "Ecuador", "El Salvador", "España", "Guatemala", "Honduras", "México", "Nicaragua", "Panamá", "Paraguay", "Perú", "Puerto Rico", "República Dominicana", "Uruguay", "Venezuela"];
$categorias = ['Tecnología', 'Hogar', 'Moda', 'Salud', 'Hobby', 'Otros'];
?>

<div class="container mt-4">
    <div class="card shadow-sm p-4">
        <h2 class="mb-4">Editar Anuncio</h2>
        
        <form action="../app/controllers/AnuncioController.php?action=actualizar" method="POST">
            <input type="hidden" name="id" value="<?php echo $anuncio_actual['id']; ?>">
            
            <div class="alert alert-info border-info mb-4">
                <label class="form-label fw-bold">Introduce tu Token de Seguridad para guardar cambios:</label>
                <input type="text" name="token_usuario" class="form-control" placeholder="Tu código secreto" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Título</label>
                <input type="text" name="titulo" class="form-control" value="<?php echo htmlspecialchars($anuncio_actual['titulo']); ?>" required>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Categoría</label>
                    <select name="categoria" class="form-select">
                        <?php foreach($categorias as $cat): ?>
                            <option value="<?php echo $cat; ?>" <?php echo ($cat == $anuncio_actual['categoria']) ? 'selected' : ''; ?>>
                                <?php echo $cat; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Precio ($)</label>
                    <input type="number" step="0.01" name="precio" class="form-control" value="<?php echo $anuncio_actual['precio']; ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Estado</label>
                    <select name="estado" class="form-select">
                        <option value="Nuevo" <?php echo ($anuncio_actual['estado'] == 'Nuevo') ? 'selected' : ''; ?>>Nuevo</option>
                        <option value="Usado" <?php echo ($anuncio_actual['estado'] == 'Usado') ? 'selected' : ''; ?>>Usado</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Descripción</label>
                <textarea name="descripcion" class="form-control" rows="4" required><?php echo htmlspecialchars($anuncio_actual['descripcion']); ?></textarea>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">País</label>
                    <select name="pais" class="form-select">
                        <?php foreach($paises as $p): ?>
                            <option value="<?php echo $p; ?>" <?php echo ($p == $anuncio_actual['pais']) ? 'selected' : ''; ?>>
                                <?php echo $p; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Contacto</label>
                    <input type="text" name="contacto" class="form-control" value="<?php echo htmlspecialchars($anuncio_actual['contacto']); ?>" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Enlace de la Foto (URL)</label>
                <input type="url" name="imagen_url" class="form-control" value="<?php echo htmlspecialchars($anuncio_actual['imagen_url']); ?>" placeholder="https://ejemplo.com/foto.jpg">
                <div class="form-text text-muted small">Si dejas esto en blanco, se mantendrá la imagen actual.</div>
            </div>

            <button type="submit" class="btn btn-warning w-100 fw-bold py-2 shadow-sm" style="background-color: #ffc107;">Guardar Cambios</button>
            <div class="text-center mt-3">
                <a href="index.php?p=carteles" class="text-muted text-decoration-none small">Cancelar</a>
            </div>
        </form>
    </div>
</div>