<?php
// Cargar el controlador necesario
require_once '../controllers/ProductoController.php';

// Obtener el controlador y la acción de la URL (valores por defecto si no existen)
// Ejemplo: ?controller=producto&action=index 
$controllerName = $_GET['controller'] ?? 'producto';
$action = $_GET['action'] ?? 'index';

// Instanciar el controlador
if ($controllerName == 'producto') {
    $controller = new ProductoController();

    // Validar que la acción exista en el controlador antes de llamarla
    if (method_exists($controller, $action)) {
        // Ejecutar la acción (index, create, store, edit, update o delete) [cite: 31, 32, 33, 34, 35, 36]
        $controller->$action();
    } else {
        echo "La acción no existe.";
    }
} else {
    echo "El controlador no existe.";
}