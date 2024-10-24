<?php
include_once '../Conexion/conexion.php';
include_once '../models/ProductoModelo.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$producto = new Producto($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'];
    
    if (isset($_POST['accion'])) {

        if ($accion === 'eliminar') {
            if (!empty($_POST['id_producto'])) {
                $id_producto = $_POST['id_producto'];
                
                if ($producto->eliminar($id_producto)) {
                    echo "<script>
                            alert('Producto eliminado correctamente');
                            window.location.href = '../views/Productoscrud.php';  
                          </script>";
                    exit;
                } else {
                    echo "Error al eliminar el producto.";
                    exit;
                }
            } else {
                echo "ID del producto no proporcionado.";
                exit;
            }
        }
        
        elseif ($accion == 'crear') {
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
                     if ($producto->crear($id_producto, $nombre, $descripcion, $precio, $rutaDestino, $docu_prov, $stock, $categoria)) {
                        echo "<script>
                                    alert('Producto creado correctamente');
                                    window.location.href = '../views/Productoscrud.php';  
                              </script>";
                     } 
                    

                 } else {
                     echo "Error al mover la imagen.";
                 }
             } else {
                 echo "Formato de imagen no permitido.";
             }
         }
         }
              exit;  }

            
       
        // Eliminar un producto
        
        
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
