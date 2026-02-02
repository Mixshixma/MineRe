<?php
session_start();
// Usamos rutas absolutas basadas en la carpeta de este archivo
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../models/Anuncio.php';

// Obtener la acción de la URL
$action = isset($_GET['action']) ? $_GET['action'] : '';

$database = new Database();
$db = $database->getConnection();
$anuncio = new Anuncio($db);

// --- CASO 1: CREAR ---
if ($action == 'crear') {
    // Generamos el token único antes de guardar
    $nuevo_token = bin2hex(random_bytes(3)); 
    $anuncio->token = $nuevo_token; // Asegúrate de que tu modelo Anuncio tenga la propiedad $token

    $anuncio->titulo = $_POST['titulo'];
    $anuncio->categoria = $_POST['categoria'];
    $anuncio->descripcion = $_POST['descripcion'];
    $anuncio->precio = $_POST['precio'];
    $anuncio->estado = $_POST['estado'];
    $anuncio->pais = $_POST['pais'];
    $anuncio->contacto = $_POST['contacto'];
    $anuncio->imagen_url = $_POST['imagen_url'];

    // Validación Backend
    if (empty($anuncio->titulo) || empty($anuncio->precio) || empty($anuncio->contacto) || empty($anuncio->categoria) || empty($anuncio->pais)) {
        echo "Error: Campos obligatorios vacíos (incluyendo país y categoría).";
        exit;
    }

    if ($anuncio->create()) {
        // Iniciamos sesión para pasar el token a la vista de éxito
        session_start();
        $_SESSION['ultimo_token'] = $nuevo_token; 
        
        header("Location: ../../public/index.php?p=exito");
        exit;
    } else {
        echo "Error al publicar el anuncio.";
    }
} 

// --- CASO 2: ELIMINAR ---
else if ($action == 'eliminar') {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $token_usuario = isset($_POST['token']) ? $_POST['token'] : '';

    // Primero verificamos si el token es correcto
    $query = "SELECT token FROM anuncios WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $anuncio_db = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($anuncio_db && $anuncio_db['token'] === $token_usuario) {
        $anuncio->id = $id;
        if ($anuncio->delete()) {
            header("Location: ../../public/index.php?p=carteles&msg=deleted");
            exit;
        }
    } else {
        echo "Error: El token de seguridad es incorrecto.";
    }
}

// --- CASO 3: ACTUALIZAR ---
else if ($action == 'actualizar') {
    $id = $_POST['id'];
    $token_usuario = $_POST['token_usuario']; // El que escribió en el input

    // 1. Verificar token en la DB
    $query = "SELECT token FROM anuncios WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $anuncio_db = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($anuncio_db && $anuncio_db['token'] === $token_usuario) {
        // 2. Si coincide, procedemos a actualizar
        $anuncio->id = $id;
        $anuncio->titulo = $_POST['titulo'];
        $anuncio->categoria = $_POST['categoria'];
        $anuncio->descripcion = $_POST['descripcion'];
        $anuncio->precio = $_POST['precio'];
        $anuncio->estado = $_POST['estado'];
        $anuncio->pais = $_POST['pais'];
        $anuncio->contacto = $_POST['contacto'];

        if ($anuncio->update()) {
            header("Location: ../../public/index.php?p=carteles&msg=updated");
            exit;
        }
    } else {
        echo "Error: Token de seguridad incorrecto. No tienes permiso para editar este anuncio.";
    }

}
?>