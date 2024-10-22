<?php
// Asegúrate de incluir el archivo de conexión y el modelo de servicios
include_once '../Conexion/conexion.php';
include_once '../models/ServiciosModelo.php';

// Crear una instancia del modelo
$servicio = new Servicio($conn);

// Verificar si se recibió una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion'])) {
        $accion = $_POST['accion'];

        // Crear un nuevo servicio
        if ($accion === 'crear') {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];
            $categoria = $_POST['categoria'];
            $docu_prov = $_POST['docu_prov'];
            $imagen = $_FILES['imagen'];

            // Verificar si hay un error al subir la imagen
            if ($imagen['error'] === UPLOAD_ERR_OK) {
                $nombreArchivo = $imagen['name'];
                $tmpName = $imagen['tmp_name'];

                // Crear la carpeta IMAGES si no existe
                $rutaCarpeta = "../IMAGES/";
                if (!is_dir($rutaCarpeta)) {
                    mkdir($rutaCarpeta, 0755, true);
                }

                // Definir la ruta final donde se moverá la imagen
                $rutaDestino = $rutaCarpeta . $nombreArchivo;

                // Mover el archivo subido a la carpeta IMAGES
                if (move_uploaded_file($tmpName, $rutaDestino)) {
                    // Guardar el servicio en la base de datos
                    $servicio->crear(null, $nombre, $descripcion, $precio, $rutaDestino, $docu_prov, $categoria);
                    echo "Servicio agregado correctamente.";
                } else {
                    echo "Error al mover la imagen.";
                }
            } else {
                echo "Error al subir la imagen.";
            }
        }

        // Obtener todos los servicios
        if ($accion === 'obtener_todos') {
            $todosServicios = $servicio->obtenerTodos();
            echo json_encode($todosServicios); // Retorna la lista de servicios en formato JSON
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
                $nombreArchivo = $imagen['name'];
                $tmpName = $imagen['tmp_name'];

                // Crear la carpeta IMAGES si no existe
                $rutaCarpeta = "../IMAGES/";
                if (!is_dir($rutaCarpeta)) {
                    mkdir($rutaCarpeta, 0755, true);
                }

                // Definir la ruta final donde se moverá la imagen
                $rutaDestino = $rutaCarpeta . $nombreArchivo;

                // Mover el archivo subido a la carpeta IMAGES
                if (move_uploaded_file($tmpName, $rutaDestino)) {
                    // Actualizar el servicio en la base de datos
                    $servicio->actualizar($id_servicio, $nombre, $descripcion, $precio, $rutaDestino, $docu_prov, $categoria);
                    echo "Servicio actualizado correctamente.";
                } else {
                    echo "Error al mover la imagen.";
                }
            } else {
                // Si no se subió una nueva imagen, solo actualizamos los datos
                $servicio->actualizar($id_servicio, $nombre, $descripcion, $precio, null, $docu_prov, $categoria);
                echo "Servicio actualizado correctamente sin nueva imagen.";
            }
        }
    }
}
?>
