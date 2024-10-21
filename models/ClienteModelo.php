

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



class Cliente {
    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }

    // Obtener todos los cliente
    public function obtenerTodos() {
        $consulta = "SELECT * FROM cliente";
        $resultado = $this->db->query($consulta);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    // Obtener un cliente por su docu_clie
    public function obtenerPordocu_clie($docu_clie) {
        $consulta = $this->db->prepare("SELECT * FROM cliente WHERE docu_clie = ?");
        $consulta->bind_param("s", $docu_clie);
        $consulta->execute();
        $resultado = $consulta->get_result();
        return $resultado->fetch_assoc();
    }

    // Crear un nuevo cliente
    public function crear($documento, $nombre, $email, $contrasena,$celular,$apellido) {
        $consulta = $this->db->prepare("INSERT INTO cliente (docu_clie, nombre, email, contraseña,celular,apellido) VALUES (?, ?, ?, ?,?,?)");
        $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT); // Hashear la contraseña
        $consulta->bind_param("ssssss", $documento, $nombre, $email, $hashed_password,$celular,$apellido);
        return $consulta->execute();
    }

    // Actualizar un cliente
    public function actualizar($docu_clie, $nombre, $email) {
        $consulta = $this->db->prepare("UPDATE cliente SET nombre = ?, email = ? WHERE docu_clie = ?");
        $consulta->bind_param("sss", $nombre, $email, $docu_clie);
        return $consulta->execute();
    }

    // Eliminar un cliente
    public function eliminar($docu_clie) {
        $consulta = $this->db->prepare("DELETE FROM cliente WHERE docu_clie = ?");
        $consulta->bind_param("s", $docu_clie);
        return $consulta->execute();
    }

    // Iniciar sesión con docu_clie y contraseña
    public function iniciarSesion($docu_clie, $contrasena) {
        // Interpolar directamente las variables en la consulta (¡no recomendado para producción!)
        $consulta = "SELECT * FROM cliente WHERE docu_clie = '$docu_clie' AND contraseña = '$contrasena'";
    
        // Ejecutar la consulta
        $resultado = $this->db->query($consulta);
    
        // Verificar si se encontró algún cliente
        if ($resultado && $resultado->num_rows > 0) {
            return $resultado->fetch_assoc(); // Devuelve la información del cliente
        }
    
        return false; // Retorna false si las credenciales no son válidas
    }
    
    
}
?>
