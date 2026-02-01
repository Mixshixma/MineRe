<?php
class Database {
    // Parámetros de configuración de XAMPP por defecto
    private $host = "localhost";
    private $db_name = "tienda";
    private $username = "root";
    private $password = ""; // En XAMPP suele estar vacío
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            // Establecer conexión usando PDO
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            // Configurar para que lance excepciones en caso de error
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Forzar el uso de UTF-8 para evitar problemas con tildes
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>