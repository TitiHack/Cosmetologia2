<?php
class Servicio {
    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }

    // Crear un nuevo servicio
    public function crear($id_servicio, $nombre, $descripcion, $precio, $rutaDestino, $docu_prov, $categoria) {
        $consulta = $this->db->prepare("INSERT INTO servicio (id_servicio, nombre, descripcion, precio, imagen, docu_prov, categoria) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $consulta->bind_param("issdsss", $id_servicio, $nombre, $descripcion, $precio, $rutaDestino, $docu_prov, $categoria);
        return $consulta->execute();
    }

    // Actualizar un servicio
    public function actualizar($id_servicio, $nombre, $descripcion, $precio, $rutaDestino, $docu_prov, $categoria) {
        $consulta = $this->db->prepare("UPDATE servicio SET nombre = ?, descripcion = ?, precio = ?, imagen = ?, docu_prov = ?, categoria = ? WHERE id_servicio = ?");
        $consulta->bind_param("issdssi", $nombre, $descripcion, $precio, $rutaDestino, $docu_prov, $categoria, $id_servicio);
        return $consulta->execute();
    }

    // Eliminar un servicio
    public function eliminar($id_servicio) {
        $consulta = $this->db->prepare("DELETE FROM servicio WHERE id_servicio = ?");
        $consulta->bind_param("i", $id_servicio);
        return $consulta->execute();
    }

    // Obtener un servicio por ID
    public function obtenerPorCategoria($id_producto) {
        $consulta = $this->db->prepare("SELECT * FROM servicio WHERE categoria = ?");
        $consulta->bind_param("s", $categoria);
        $consulta->execute();
        $resultado = $consulta->get_result();
        return $resultado->fetch_assoc();
    }

    // Obtener todos los servicios
    public function obtenerTodos() {
        $consulta = "SELECT * FROM servicio";
        $resultado = $this->db->query($consulta);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
}
?>
