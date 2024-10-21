<?php
include_once '../Conexion/conexion.php';
include_once '../models/ProductoModelo.php';

$producto = new Producto($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion'])) {
        $accion = $_POST['accion'];

        // Crear un nuevo producto
        if ($accion === 'crear') {
            $id_producto = $_POST['id_producto'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];
            $imagen = $_POST['imagen'];
            $docu_prov = $_POST['docu_prov'];
            $stock = $_POST['stock'];
            $categoria = $_POST['categoria']; // Nuevo campo para categoría

            // Crear el producto
            $producto->crear($id_producto, $nombre, $descripcion, $precio, $imagen, $docu_prov, $stock, $categoria);
            // Redirigir a la página de gestión de productos
            header("Location: ../views/productos.php"); // Cambia esta ruta a la correcta
            exit; // Asegúrate de llamar exit después de header
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
