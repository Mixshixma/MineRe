<?php
// No es necesario session_start() aquí si ya lo pusiste en el index.php
$token = isset($_SESSION['ultimo_token']) ? $_SESSION['ultimo_token'] : null;
unset($_SESSION['ultimo_token']); 
?>

<div class="text-center">
    <div class="card shadow border-0 p-5 bg-white">
        <div class="mb-4">
            <h1 class="display-5 text-success">¡Anuncio Publicado! 🎉</h1>
            <p class="lead">Tu cartel ya está en el tablón.</p>
        </div>

        <?php if($token): ?>
            <div class="alert alert-warning border-dark d-inline-block p-4">
                <h4 class="alert-heading">🔑 Código de Gestión</h4>
                <p>Usa este código para editar o borrar tu anuncio:</p>
                <div class="bg-dark text-white rounded p-3 mb-2">
                    <span class="h2 font-monospace"><?php echo $token; ?></span>
                </div>
                <p class="small text-muted mb-0">¡Cópialo ahora! No se volverá a mostrar.</p>
            </div>
        <?php else: ?>
            <div class="alert alert-danger">
                No se pudo recuperar el token. Si necesitas borrar el anuncio, contacta a soporte.
            </div>
        <?php endif; ?>

        <div class="mt-4">
            <a href="index.php?p=carteles" class="btn btn-outline-primary">Ver todos los carteles</a>
        </div>
    </div>
</div>