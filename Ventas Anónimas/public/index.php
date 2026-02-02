<?php 
session_start();
// 1. Definir la raíz del proyecto de forma absoluta
// Si el index está en /public, subimos un nivel para llegar a la raíz del proyecto
define('ROOT_PATH', dirname(__DIR__) . '/');

// 2. Cargar la base de datos y modelos AQUÍ una sola vez
require_once ROOT_PATH . 'config/db.php';
require_once ROOT_PATH . 'app/models/Anuncio.php';

// 3. Inicializar la conexión
$database = new Database();
$db = $database->getConnection();
$anuncio = new Anuncio($db);

$pagina = isset($_GET['p']) ? $_GET['p'] : 'inicio';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carteles Anónimos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php?p=inicio">Carteles Anónimos</a>
        <div class="navbar-nav">
            <a class="nav-link <?php echo ($pagina == 'inicio') ? 'active' : ''; ?>" href="index.php?p=inicio">Inicio</a>
            
            <a class="nav-link <?php echo ($pagina == 'carteles') ? 'active' : ''; ?>" href="index.php?p=carteles">Carteles</a>
            
            <a class="nav-link <?php echo ($pagina == 'usted') ? 'active' : ''; ?>" href="index.php?p=usted">Publicar</a>
            
            <a class="nav-link <?php echo ($pagina == 'soporte') ? 'active' : ''; ?>" href="index.php?p=soporte">Soporte</a>
        </div>
    </div>
</nav>

 <div class="container mt-4">
    <?php 
        switch($pagina) {
            case 'carteles':
                include '../app/views/carteles.php';
                break;
            case 'usted':
                include '../app/views/registrar_anuncio.php';
                break;
            case 'exito':
                include '../app/views/exito.php';
                break;
            case 'soporte':
?>
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2 class="mb-4">Centro de Ayuda y Soporte</h2>
            <p class="text-muted mb-5">Consulta nuestras preguntas frecuentes antes de contactar con el equipo de moderación.</p>

            <div class="accordion mb-5" id="accordionFAQ">
                
                <div class="accordion-item shadow-sm">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            ¿Qué es el Token y por qué es tan importante?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                        <div class="accordion-body text-secondary">
                            El <strong>Token</strong> es una clave alfanumérica única generada al crear tu anuncio. Al no tener cuentas de usuario, el token es la única forma de demostrar que eres el dueño del cartel para poder editarlo o borrarlo. <strong>Si lo pierdes, el anuncio permanecerá hasta que culmine su fecha de caducidad.</strong>
                        </div>
                    </div>
                </div>

                <div class="accordion-item shadow-sm">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            ¿Cuánto tiempo dura mi anuncio publicado?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                        <div class="accordion-body text-secondary">
                            El tiempo máximo es de 7 días. Pasado esos dias, un administrador eliminará su anuncio de nuestra base de datos para mantener el tablón actualizado.
                        </div>
                    </div>
                </div>

                <div class="accordion-item shadow-sm">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                            ¿Puedo extender mi anuncio?
                        </button>
                    </h2>
                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                        <div class="accordion-body text-secondary">
                           Para que su anuncio siga vigente en nuestra página usted puede hacer un pago contactándose con el correo de soporte.
                        </div>
                    </div>
                </div>

                    <div class="accordion-item shadow-sm">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" tpe="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            ¿Como puedo contactarme para recibir nuevamente el token?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                        <div class="accordion-body text-secondary">
                            Para volver a recibir su token tiene que escribirnos detalladamente a través del correo de soporte la hora y fecha exacta en que publicó su cartel. Caso contrario, su petición será ignorada.
                        </div>
                    </div>
                </div>

            </div>

            <div class="card bg-light border-0 p-4 mt-4">
                <h4 class="fw-bold">¿Aún necesitas ayuda?</h4>
                <p>Si tienes problemas técnicos o quieres reportar un anuncio fraudulento, escríbenos:</p>
                <div class="d-flex flex-column gap-2">
                    <span>📧 <strong>Soporte:</strong> soporte@ventas-anonimas.com</span>
                    <span>🛡️ <strong>Denuncias:</strong> moderacion@ventas-anonimas.com</span>
                </div>
            </div>
        </div>
    </div>
<?php
    break;
            default:
?>
    <div class="row align-items-center mb-5 mt-3">
        <div class="col-md-7">
            <h2 class="display-4 fw-bold text-dark">¡Vende sin dejar rastro!</h2>
            <p class="lead text-muted">
                Bienvenido al tablón de anuncios más efímero de la web. Aquí no necesitas correos, contraseñas ni perfiles. Solo publicas, guardas tu <strong>Token</strong> y cierras el trato.
            </p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-4">
                <a href="index.php?p=usted" class="btn btn-warning btn-lg px-4 me-md-2 fw-bold">➕ Publicar ahora</a>
                <a href="index.php?p=carteles" class="btn btn-outline-dark btn-lg px-4">🔍 Ver carteles</a>
            </div>
        </div>


        <div class="col-md-5 d-none d-md-block text-center">
        <img src="/guyfawkes.png" alt="Anónimo" class="mask-img">
        </div>
    </div>

    <hr class="my-5">

    <div class="row g-4 mb-5">
        <div class="col-12">
            <h3 class="mb-4">Reglas de la Comunidad</h3>
        </div>
        
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold">1. El Token es Ley 🔑</h5>
                    <p class="card-text text-secondary small">Al publicar recibirás un código. Si lo pierdes, no podrás borrar ni editar tu anuncio.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold">2. Sin Datos Personales 🚫</h5>
                    <p class="card-text text-secondary small">Por tu seguridad, no pongas tu dirección real en la descripción. Usa métodos de contacto genéricos (Telegram, WhatsApp, Mail).</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold">3. Prohibido lo Ilegal ⚖️</h5>
                    <p class="card-text text-secondary small">Cualquier anuncio de sustancias controladas, armas o contenido explícito será eliminado sin previo aviso.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold">4. Caducidad Efímera ⏳</h5>
                    <p class="card-text text-secondary small">Los anuncios tienen un límite de exposición. Si el producto se vende, usa tu token para borrar el cartel y no recibir más spam.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold">5. Responsabilidad 🤝</h5>
                    <p class="card-text text-secondary small">Esta plataforma es solo un tablón de anuncios. La negociación y el intercambio ocurren bajo tu propio riesgo.</p>
                </div>
            </div>
        </div>
    </div>
<?php 
    break;
            case 'editar':
             include '../app/views/editar_anuncio.php';
             break;
        }
    ?>
</div>

    <script src="js/validaciones.js"></script>
</body>
</html>