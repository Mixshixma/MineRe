<?php
class Anuncio {
    private $conn;
    private $table_name = "anuncios";

    public $id;
    public $titulo;
    public $categoria;
    public $descripcion;
    public $precio;
    public $estado;
    public $pais;
    public $contacto;
    public $imagen_url;
    public $token;

    public function __construct($db) {
        $this->conn = $db;
    }

public function read($pais = null, $categoria = null, $estado = null) {
    $query = "SELECT * FROM " . $this->table_name . " WHERE 1=1";

    if ($pais) {
        $query .= " AND pais = :pais";
    }
    if ($categoria) {
        $query .= " AND categoria = :categoria";
    }
    if ($estado) {
        $query .= " AND estado = :estado";
    }

    $query .= " ORDER BY fecha_publicacion DESC";

    $stmt = $this->conn->prepare($query);

    if ($pais) $stmt->bindParam(":pais", $pais);
    if ($categoria) $stmt->bindParam(":categoria", $categoria);
    if ($estado) $stmt->bindParam(":estado", $estado);

    $stmt->execute();
    return $stmt;

}

    public function create() {
        if(empty($this->token)) {
        $this->token = bin2hex(random_bytes(4)); // Genera algo como 'a1b2c3d4'
    }
        $query = "INSERT INTO " . $this->table_name . " 
                  SET titulo=:titulo, categoria=:categoria, descripcion=:descripcion, 
                      precio=:precio, estado=:estado, pais=:pais, 
                      contacto=:contacto, imagen_url=:imagen_url, token=:token";

        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->sanitize();

        $stmt->bindParam(":titulo", $this->titulo);
        $stmt->bindParam(":categoria", $this->categoria);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":estado", $this->estado);
        $stmt->bindParam(":pais", $this->pais);
        $stmt->bindParam(":contacto", $this->contacto);
        $stmt->bindParam(":imagen_url", $this->imagen_url);
        $stmt->bindParam(":token", $this->token);

        return $stmt->execute();
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET titulo=:titulo, categoria=:categoria, descripcion=:descripcion, 
                      precio=:precio, estado=:estado, pais=:pais, contacto=:contacto 
                  WHERE id=:id";

        $stmt = $this->conn->prepare($query);
        $this->sanitize();
        
        $stmt->bindParam(":titulo", $this->titulo);
        $stmt->bindParam(":categoria", $this->categoria);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":estado", $this->estado);
        $stmt->bindParam(":pais", $this->pais);
        $stmt->bindParam(":contacto", $this->contacto);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);
        return $stmt->execute();
    }

    // Función interna para no repetir código de limpieza
    private function sanitize() {
        $this->titulo = htmlspecialchars(strip_tags($this->titulo));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->pais = htmlspecialchars(strip_tags($this->pais));
        $this->contacto = htmlspecialchars(strip_tags($this->contacto));
    }
}
?>