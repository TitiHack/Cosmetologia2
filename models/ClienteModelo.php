

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
    public function crear($docu_clie, $nombre, $email, $contrasena,$celular,$apellido) {
        $consulta = $this->db->prepare("INSERT INTO cliente (docu_clie, nombre, email, contraseña,celular,apellido) VALUES (?, ?, ?, ?,?,?)");
        $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT); // Hashear la contraseña
        $consulta->bind_param("isssss",$docu_clie, $nombre, $email, $hashed_password,$celular,$apellido);
        return $consulta->execute();
    }
    public function crearcliente($docu_clie, $nombre, $email, $contrasena,$celular,$apellido) {
        $consulta = $this->db->prepare("INSERT INTO cliente (docu_clie, nombre, email, contraseña,celular,apellido) VALUES (?, ?, ?, ?,?,?)");
        $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT); // Hashear la contraseña
        $consulta->bind_param("isssss",$docu_clie, $nombre, $email, $hashed_password,$celular,$apellido);
        return $consulta->execute();
    }

    // Actualizar un cliente
    public function actualizar($docu_clie, $nombre, $email, $apellido, $contrasena, $celular) {
        $consulta = $this->db->prepare("UPDATE cliente SET nombre = ?, email = ?, apellido = ?, contraseña = ?,  celular = ? WHERE docu_clie = ?");
        $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);
        $consulta->bind_param("sssssi", $nombre, $apellido, $hashed_password, $email, $celular, $docu_clie);
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
        // Preparar la consulta utilizando sentencias preparadas para evitar inyecciones SQL
        $consulta = $this->db->prepare("SELECT * FROM cliente WHERE docu_clie = ?");
        
        // Vincular el parámetro del docu_clie a la consulta
        $consulta->bind_param("s", $docu_clie);
        $consulta->execute();
        
        // Obtener el resultado
        $resultado = $consulta->get_result();
        
        // Verificar si se encontró algún cliente con el docu_clie proporcionado
        if ($resultado && $resultado->num_rows > 0) {
            $cliente = $resultado->fetch_assoc();
            
            // Verificar si la contraseña ingresada coincide con la contraseña hasheada en la base de datos
            if (password_verify($contrasena, $cliente['contraseña'])) {
                return $cliente; // La contraseña es correcta, devolver la información del cliente
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
