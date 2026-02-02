<?php
// Array de países de habla hispana para el select
$paises = [
    "Argentina", "Bolivia", "Chile", "Colombia", "Costa Rica", "Cuba", 
    "Ecuador", "El Salvador", "España", "Guatemala", "Honduras", "México", 
    "Nicaragua", "Panamá", "Paraguay", "Perú", "Puerto Rico", 
    "República Dominicana", "Uruguay", "Venezuela"
];

// Array de categorías (debe coincidir con el ENUM de tu SQL)
$categorias = ['Tecnología', 'Hogar', 'Moda', 'Salud', 'Hobby', 'Otros'];
?>

<div class="container mt-4">
    <div class="card shadow-sm p-4">
        <h2 class="mb-4">Publicar Anuncio Anónimo</h2>
        
        <form id="formAnuncio" action="../app/controllers/AnuncioController.php?action=crear" method="POST" enctype="multipart/form-data">
            
            <div class="mb-3">
                <label class="form-label fw-bold">Título del Producto</label>
                <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Ej. Bicicleta de montaña" required>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Categoría</label>
                    <select name="categoria" class="form-select">
                        <?php foreach($categorias as $cat): ?>
                            <option value="<?php echo $cat; ?>"><?php echo $cat; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Precio ($)</label>
                    <input type="number" step="0.01" name="precio" id="precio" class="form-control" placeholder="0.00" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Estado</label>
                    <select name="estado" class="form-select">
                        <option value="Nuevo">Nuevo</option>
                        <option value="Usado" selected>Usado</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="4" placeholder="Describe brevemente lo que vendes..." required></textarea>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">País</label>
                    <select name="pais" id="pais" class="form-select" required>
                        <option value="" disabled selected>Selecciona tu país</option>
                        <?php foreach($paises as $p): ?>
                            <option value="<?php echo $p; ?>"><?php echo $p; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Email</label>
                    <input type="text" name="contacto" id="contacto" class="form-control" placeholder="¿Cómo te contactan?" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Enlace de la Foto</label>
                <input type="url" name="imagen_url" id="imagen_url" class="form-control" placeholder="https://ejemplo.com/foto.jpg">
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-bold py-2 shadow-sm">Publicar Ahora</button>
            
            <div class="text-center mt-3">
                <p class="small text-muted text-decoration-none">Al publicar, se generará un código de seguridad para gestionar tu anuncio.</p>
            </div>
        </form>
    </div>
</div>