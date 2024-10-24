<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Producto {
    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }

    // Crear un nuevo producto
    public function crear($id_producto, $nombre, $descripcion, $precio, $imagen, $docu_prov, $stock, $categoria) {
        $consulta = $this->db->prepare("INSERT INTO producto (id_producto, nombre, descripcion, precio, imagen, docu_prov, stock, categoria) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $consulta->bind_param("issdsiss", $id_producto, $nombre, $descripcion, $precio, $imagen, $docu_prov, $stock, $categoria);
        return $consulta->execute();
    }

    // Actualizar un producto
    public function actualizar($id_producto, $nombre, $descripcion, $precio, $imagen, $docu_prov, $stock, $categoria) {
        $consulta = $this->db->prepare("UPDATE producto SET nombre = ?, descripcion = ?, precio = ?, imagen = ?, docu_prov = ?, stock = ?, categoria = ? WHERE id_producto = ?");
        $consulta->bind_param("issdsisi", $id_producto, $nombre, $descripcion, $precio, $imagen, $docu_prov, $stock, $categoria);
        return $consulta->execute();
        
    }

    // Eliminar un producto
  public function eliminar($id_producto) {
    $sql = "DELETE FROM producto WHERE id_producto = ?"; // Usa un marcador de posición
    $stmt = $this->db->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('i', $id_producto); // Asegúrate de que `id_producto` es un entero.
        
        if ($stmt->execute()) {
            return true; // Retorna true si la eliminación fue exitosa
        } else {
            return false; // Retorna false si hubo un error
        }
    } else {
        // Manejo de errores si `prepare` falla
        return false; // Retorna false si hubo un error en la preparación
    }
}


    // Obtener un producto por ID
    public function obtenerPorCategoria($id_producto) {
        $consulta = $this->db->prepare("SELECT * FROM producto WHERE categoria = ?");
        $consulta->bind_param("s", $categoria);
        $consulta->execute();
        $resultado = $consulta->get_result();
        return $resultado->fetch_assoc();
    }

    // Obtener todos los productos
    public function obtenerTodos() {
        $consulta = "SELECT * FROM producto";
        $resultado = $this->db->query($consulta);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
}
?>
