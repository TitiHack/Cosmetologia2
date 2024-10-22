<?php
include_once '../Conexion/conexion.php';
include_once '../models/ProductoModelo.php';

$producto = new Producto($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion'])) {
        $id_producto = $_POST['id_producto'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];
            $imagen = $_FILES['imagen'];
            $docu_prov = $_POST['docu_prov'];
            $stock = $_POST['stock'];
            $categoria = $_POST['categoria']; // Nuevo campo para categoría

         // Verificar si hay un error al subir la imagen
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
 
                 // Mover el archivo subido a la carpeta IMAGES
                 if (move_uploaded_file($tmpName, $rutaDestino)) {
                     // Guardar el producto en la base de datos (debes implementar la lógica de tu modelo)
                     $producto->crear($id_producto, $nombre, $descripcion, $precio, $rutaDestino, $docu_prov, $stock, $categoria);
 
                     echo "Producto agregado correctamente.";
                 } else {
                     echo "Error al mover la imagen.";
                 }
             } else {
                 echo "Formato de imagen no permitido.";
             }
         }
         }
        
        // Actualizar un producto
        elseif ($accion === 'actualizar') {
            $id_producto = $_POST['id_producto'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];
            $imagen = $_POST['imagen'];
            $docu_prov = $_POST['docu_prov'];
            $stock = $_POST['stock'];
            $categoria = $_POST['categoria']; // Nuevo campo para categoría

            // Actualizar el producto
            $producto->actualizar($id_producto, $nombre, $descripcion, $precio, $imagen, $docu_prov, $stock, $categoria);
            // Redirigir a la página de gestión de productos
            header("Location: ../views/productos.php");
            exit;
        }

        // Eliminar un producto
        elseif ($accion === 'eliminar') {
            $id_producto = $_POST['id_producto'];
            $producto->eliminar($id_producto);
            // Redirigir a la página de gestión de productos
            header("Location: ../views/productos.php");
            exit;
        }
    }


// Obtener un producto por ID
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id_producto'])) {
        $id_producto = $_GET['id_producto'];
        $productoInfo = $producto->obtenerPorId($id_producto);
        
    // Obtener todos los productos
    } else {
        $todosProductos = $producto->obtenerTodos();
    }
}
?>
