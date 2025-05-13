<?php
include_once '../BD/conexion.php';

class LibroModel {
    private $conn;

    public function __construct() {
        $this->conn = conectar();
    }

    public function obtenerCategoriaId($nombreCategoria) {
        $query = "SELECT id FROM categorias WHERE nombre = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $nombreCategoria);
        $stmt->execute();
        $stmt->bind_result($id);
        $stmt->fetch();
        return $id;
    }    

    // Insertar una nueva categoría
    public function insertarCategoria($nombre_categoria) {
        $query = "INSERT INTO categorias (nombre) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $nombre_categoria);
        if ($stmt->execute()) {
            return $this->conn->insert_id; 
        }
        return false;
    }

    // Modelo LibroModel.php
    public function categoriaExiste($nombreCategoria) {
        $query = "SELECT COUNT(*) FROM categorias WHERE nombre = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $nombreCategoria);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        return $count > 0;
    }

    public function obtenerLibrosPorCategoria($categoria_id) {
        $query = "SELECT libros.*, categorias.nombre AS categoria_nombre
                  FROM libros
                  INNER JOIN categorias ON libros.categoria_id = categorias.id
                  WHERE categoria_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $categoria_id);
        $stmt->execute();
        $resultado = $stmt->get_result();
    
        $libros = [];
        while ($fila = $resultado->fetch_assoc()) {
            $libros[] = $fila;
        }
        return $libros;
    }    

    public function obtenerLibrosConCategoria() {
        $query = "SELECT libros.*, categorias.nombre AS categoria_nombre
                  FROM libros
                  INNER JOIN categorias ON libros.categoria_id = categorias.id";
        $result = $this->conn->query($query);
    
        $libros = [];
        while ($fila = $result->fetch_assoc()) {
            $libros[] = $fila;
        }
        return $libros;
    }    
    
    public function obtenerCategorias() {
        $query = "SELECT id, nombre FROM categorias";
        $result = $this->conn->query($query);
        return $result;
    }
    
    // Insertar el libro, verificando si la categoría existe o si se debe crear una nueva
    public function insertarLibro($titulo, $autor, $descripcion, $precio, $stock, $imagen, $categoria_id, $nueva_categoria = null) {
        // Si se pasa una nueva categoría, verificar si existe, sino, crearla
        if ($nueva_categoria && !$this->categoriaExiste($nueva_categoria)) {
            $categoria_id = $this->insertarCategoria($nueva_categoria);
        }

        // Ahora que tenemos el ID de la categoría (existente o nueva), insertamos el libro
        $stmt = $this->conn->prepare("INSERT INTO libros (titulo, autor, descripcion, precio, stock, imagen, categoria_id) 
                                      VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssdisi", $titulo, $autor, $descripcion, $precio, $stock, $imagen, $categoria_id);
        return $stmt->execute();
    }

        // Obtener libro por ID
    public function obtenerLibroPorId($id) {
        $sql = "SELECT * FROM libros WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

    // Actualizar el stock
    public function actualizarStock($id, $nuevoStock) {
        $sql = "UPDATE libros SET stock = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $nuevoStock, $id);
        return $stmt->execute();
    }

    public function buscarLibros($termino) {
        $stmt = $this->conn->prepare("
            SELECT libros.*, categorias.nombre AS categoria 
            FROM libros 
            LEFT JOIN categorias ON libros.categoria_id = categorias.id 
            WHERE libros.titulo LIKE ? OR libros.autor LIKE ?
        ");
        $likeTermino = "%$termino%";
        $stmt->bind_param("ss", $likeTermino, $likeTermino);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
    
    

}
?>
