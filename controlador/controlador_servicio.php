<?php
// Asegúrate de incluir el archivo de conexión y el modelo de servicios
include_once '../Conexion/conexion.php';
include_once '../models/ServiciosModelo.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servicio = new Servicio($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion'])) {
        $accion = $_POST['accion'];
        
        if ($accion === 'agregar') {
            
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];
            $imagen = $_FILES['imagen'];
            $categoria = $_POST['categoria'];
            $docu_prov = $_SESSION['proveedor']['docu_prov'];

            // Validar imagen antes de subirla
            if ($imagen['error'] === UPLOAD_ERR_OK) {
                $nombreArchivo = $imagen['name'];
                $tipoArchivo = $imagen['type'];
                $tamañoArchivo = $imagen['size'];
                $tmpName = $imagen['tmp_name'];

                // Verificar si es una imagen válida
                $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
                $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
                
                if (in_array($extension, $extensionesPermitidas)) {
                    // Crear la carpeta IMAGES si no existe
                    $rutaCarpeta = "../IMAGES/";
                    if (!is_dir($rutaCarpeta)) {
                        mkdir($rutaCarpeta, 0755, true);
                    }

                    // Renombrar el archivo para evitar colisiones
                    $nombreArchivo = uniqid() . '.' . $extension;
                    $rutaDestino = $rutaCarpeta . $nombreArchivo;

                    // Mover el archivo subido
                    if (move_uploaded_file($tmpName, $rutaDestino)) {
                        // Llamar al método de creación
                        $servicio->crear(null, $nombre, $descripcion, $precio, $rutaDestino, $docu_prov, $categoria);
                        echo "<script>
                        alert('Producto creado correctamente');
                        window.location.href = '../views/servicios.php';  

                  </script>";                    } else {
                        echo "Error al mover la imagen.";
                    }
                } else {
                    echo "Formato de imagen no permitido.";
                }
            } else {
                echo "Error al subir la imagen.";
            }
        }

        // Eliminar un servicio
        if ($accion === 'eliminar') {
            $id_servicio = $_POST['id_servicio'];
            if ($servicio->eliminar($id_servicio)) {
                echo "Servicio eliminado correctamente.";
            } else {
                echo "Error al eliminar el servicio.";
            }
        }

        // Actualizar un servicio
        if ($accion === 'actualizar') {
            $id_servicio = $_POST['id_servicio'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];
            $categoria = $_POST['categoria'];
            $docu_prov = $_POST['docu_prov'];
            $imagen = $_FILES['imagen'];

            // Manejar la imagen
            if ($imagen['error'] === UPLOAD_ERR_OK) {
                $nombreArchivo = uniqid() . '.' . pathinfo($imagen['name'], PATHINFO_EXTENSION);
                $tmpName = $imagen['tmp_name'];
                $rutaCarpeta = "../IMAGES/";

                if (!is_dir($rutaCarpeta)) {
                    mkdir($rutaCarpeta, 0755, true);
                }
                $rutaDestino = $rutaCarpeta . $nombreArchivo;

                if (move_uploaded_file($tmpName, $rutaDestino)) {
                    $servicio->actualizar($id_servicio, $nombre, $descripcion, $precio, $rutaDestino, $docu_prov, $categoria);
                    echo "Servicio actualizado correctamente.";
                } else {
                    echo "Error al mover la imagen.";
                }
            } else {
                $servicio->actualizar($id_servicio, $nombre, $descripcion, $precio, null, $docu_prov, $categoria);
                echo "Servicio actualizado correctamente sin nueva imagen.";
            }
        }
    }
}
?>
