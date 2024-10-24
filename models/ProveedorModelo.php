

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



class Proveedor {
    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }

    // Obtener todos los proveedor
    public function obtenerTodos() {
        $consulta = "SELECT * FROM proveedor";
        $resultado = $this->db->query($consulta);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    // Obtener un proveedor por su docu_prov
    public function obtenerPordocu_clie($docu_prov) {
        $consulta = $this->db->prepare("SELECT * FROM proveedor WHERE docu_prov = ?");
        $consulta->bind_param("s", $docu_prov);
        $consulta->execute();
        $resultado = $consulta->get_result();
        return $resultado->fetch_assoc();
    }

    // Crear un nuevo proveedor
    public function crear($docu_prov, $nombre, $email, $contrasena,$celular,$apellido) {
        $consulta = $this->db->prepare("INSERT INTO proveedor (docu_prov, nombre, email, contraseña,celular,apellido) VALUES (?, ?, ?, ?,?,?)");
        $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT); // Hashear la contraseña
        $consulta->bind_param("isssss",$docu_prov, $nombre, $email, $hashed_password,$celular,$apellido);
        return $consulta->execute();
    }

    // Actualizar un proveedor
    public function actualizar($docu_prov, $nombre, $email, $apellido, $contrasena, $celular) {
        $consulta = $this->db->prepare("UPDATE proveedor SET nombre = ?, email = ?, contraseña = ?, apellido = ?, celular = ? WHERE docu_prov = ?");
        $consulta->bind_param("sssssi", $nombre, $apellido, $contrasena, $email, $celular, $docu_prov);
        return $consulta->execute();
    }

    // Eliminar un proveedor
    public function eliminar($docu_prov) {
        $consulta = $this->db->prepare("DELETE FROM proveedor WHERE docu_prov = ?");
        $consulta->bind_param("s", $docu_prov);
        return $consulta->execute();
    }

    // Iniciar sesión con docu_prov y contraseña
    public function iniciarSesion($docu_prov, $contrasena) {
        // Preparar la consulta utilizando sentencias preparadas para evitar inyecciones SQL
        $consulta = $this->db->prepare("SELECT * FROM proveedor WHERE docu_prov = ?");
        
        // Vincular el parámetro del docu_prov a la consulta
        $consulta->bind_param("s", $docu_prov);
        $consulta->execute();
        
        // Obtener el resultado
        $resultado = $consulta->get_result();
        
        // Verificar si se encontró algún proveedor con el docu_prov proporcionado
        if ($resultado && $resultado->num_rows > 0) {
            $proveedor = $resultado->fetch_assoc();
            
            // Verificar si la contraseña ingresada coincide con la contraseña hasheada en la base de datos
            if (password_verify($contrasena, $proveedor['contraseña'])) {
                return $proveedor; // La contraseña es correcta, devolver la información del proveedor
            } else {
                // Contraseña incorrecta
                return false;
            }
        } else {
            // Documento no encontrado
            return false;
        }
    }
    
    
    
}
?>
