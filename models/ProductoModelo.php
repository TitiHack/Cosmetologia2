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
    public function actualizar($id_producto, $nombre, $descripcion, $precio, $docu_prov, $stock, $categoria) {
        $consulta = $this->db->prepare("UPDATE producto SET nombre = ?, descripcion = ?, precio = ?, docu_prov = ?, stock = ?, categoria = ? WHERE id_producto = ?");
        $consulta->bind_param("ssdsisi", $nombre, $descripcion, $precio, $docu_prov, $stock, $categoria, $id_producto);
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

    public function obtenerPorId($id_producto) {
        // Preparar la consulta para obtener el producto por ID
        $sql = "SELECT * FROM producto WHERE id_producto = ?";
        
        // Preparar la declaración
        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            // Manejar error si no se puede preparar la declaración
            die("Error en la preparación de la consulta: " . $this->conn->error);
        }
        
        // Vincular el parámetro
        $stmt->bind_param('i', $id_producto);
        
        // Ejecutar la consulta
        $stmt->execute();
        
        // Obtener el resultado
        $result = $stmt->get_result();
        
        // Verificar si se encontró un producto
        if ($result->num_rows > 0) {
            return $result->fetch_assoc(); // Retorna el producto como un array asociativo
        } else {
            return null; // Retorna null si no se encuentra el producto
        }
        
        // Cerrar la declaración
        $stmt->close();
    }
    public function restarStock($productoId, $cantidad) {
        // Asegúrate de que la consulta esté correctamente estructurada
        $sql = "UPDATE producto SET stock = stock - ? WHERE id_producto = ?";
        
        // Preparar la consulta
        $stmt = $this->db->prepare($sql);
        
        if ($stmt === false) {
            die('Error en la preparación de la consulta: ' . $this->conn->error);
        }

        // Bind de los parámetros
        $stmt->bind_param('ii', $cantidad, $productoId);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true; // Stock actualizado con éxito
        } else {
            echo 'Error al actualizar: ' . $stmt->error; // Imprimir error en caso de fallo
            return false; // Error al actualizar
        }

        // Cerrar el statement
        $stmt->close();
    }
    public function obtenerProductoPorId($productoId) {
        $sql = "SELECT * FROM producto WHERE id_producto = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $productoId); // Cambia a "i" si id es un entero
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        return $resultado->fetch_assoc(); // Devuelve el producto como un array asociativo
    }
    public function validarStock($productoId, $cantidad) {
        $sql = "SELECT stock FROM productos WHERE id_producto = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $productoId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            // Verifica si el stock es suficiente
            return $row['stock'] >= $cantidad;
        } else {
            return false; // Si no encuentra el producto, retorna false
        }
    }
    
    
}
?>

