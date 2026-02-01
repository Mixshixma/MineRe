<?php
require_once '../models/Producto.php';

class ProductoController {
    private $modelo;

    public function __construct() {
        $this->modelo = new Producto();
    }

    // Listar producto
    public function index() {
        $stmt = $this->modelo->listar();
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require_once '../views/productos/index.php';
    }

    // Mostrar formulario de creación [cite: 32]
    public function create() {
        require_once '../views/productos/create.php';
    }

    // Guardar el producto con validaciones
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errores = $this->validar($_POST);

            if (empty($errores)) {
                $this->modelo->nombre = $_POST['nombre'];
                $this->modelo->descripcion = $_POST['descripcion'];
                $this->modelo->precio = $_POST['precio'];
                $this->modelo->stock = $_POST['stock'];

                if ($this->modelo->crear()) {
                    header("Location: index.php?controller=producto&action=index");
                }
            } else {
                // Si hay errores, volver al formulario y mostrarlos [cite: 41]
                require_once '../views/productos/create.php';
            }
        }
    }

    // Mostrar formulario de edición
    public function edit() {
        $id = $_GET['id'] ?? null;
        $producto = $this->modelo->obtenerPorId($id);
        require_once '../views/productos/edit.php';
    }

    // Actualizar producto
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $errores = $this->validar($_POST);

            if (empty($errores)) {
                $this->modelo->id = $id;
                $this->modelo->nombre = $_POST['nombre'];
                $this->modelo->descripcion = $_POST['descripcion'];
                $this->modelo->precio = $_POST['precio'];
                $this->modelo->stock = $_POST['stock'];

                if ($this->modelo->actualizar()) {
                    header("Location: index.php?controller=producto&action=index");
                }
            } else {
                $producto = $_POST; // Para no perder lo que el usuario escribió
                require_once '../views/productos/edit.php';
            }
        }
    }

    // Eliminar producto
    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->modelo->eliminar($id);
        }
        header("Location: index.php?controller=producto&action=index");
    }

    // Método privado para centralizar las validaciones requeridas
    private function validar($datos) {
        $errores = [];
        if (empty($datos['nombre']) || strlen($datos['nombre']) < 3) {
            $errores[] = "El nombre es obligatorio y debe tener al menos 3 caracteres.";
        }
        if (!isset($datos['precio']) || $datos['precio'] <= 0) {
            $errores[] = "El precio debe ser mayor a 0.";
        }
        if (!isset($datos['stock']) || $datos['stock'] < 0) {
            $errores[] = "El stock no puede ser negativo.";
        }
        return $errores;
    }
}