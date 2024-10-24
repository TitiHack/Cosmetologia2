<?php
// Asegúrate de incluir el archivo de conexión y el modelo de servicios
include_once '../Conexion/conexion.php';
include_once '../models/ServiciosModel.php';

$servicio = new Servicio($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion'])) {
        $accion = $_POST['accion'];
        $categorias= $_POST('categorias');
       
        if ($accion === 'agregar') {
            $id_servicio = $_POST['id_servicio'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];
            $imagen = $_FILES['imagen'];

            $categoria = $_POST['categoria'];
            $docu_prov = $_POST['docu_prov'];
            echo $categoria;            

            if ($imagen['error'] === UPLOAD_ERR_OK) {
                $nombreArchivo = $imagen['name'];
                $tipoArchivo = $imagen['type'];
                $tamañoArchivo = $imagen['size'];
                $tmpName = $imagen['tmp_name'];
    
                // Verificar si es una imagen válida (puedes agregar más validaciones según tus necesidades)
                $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
                $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
                
                if (in_array($extension, $extensionesPermitidas)) {
                    // Crear la carpeta IMAGES si no existe
                    $rutaCarpeta = "../IMAGES/";
                    if (!is_dir($rutaCarpeta)) {
                        mkdir($rutaCarpeta, 0755, true);
                    }
    
                    // Definir la ruta final donde se moverá la imagen
                    $rutaDestino = $rutaCarpeta . $nombreArchivo;
                    echo $rutaDestino; // Asegúrate de que esta variable tiene el valor correcto

    
                    // Mover el archivo subido a la carpeta IMAGES
                    if (move_uploaded_file($tmpName, $rutaDestino)) {
                        $servicio->crear(null, $nombre, $descripcion, $precio, $rutaDestino, $docu_prov, $categoria);
    
                        echo "Servicio agregado correctamente.";
                    } else {
                        echo "Error al mover la imagen.";
                    }
                } else {
                    echo "Formato de imagen no permitido.";
                }
            }
            
        }

        // Obtener todos los servicios
        if ($categorias) {
            $todosServicios = $servicio->obte();
            return json_encode($todosServicios); // Retorna la lista de servicios en formato JSON
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
