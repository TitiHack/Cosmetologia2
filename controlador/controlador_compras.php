<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include_once '../Conexion/conexion.php';
include_once '../models/ProductoModelo.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productoModelo = new Producto($conn);

    // Asegúrate de que el carrito existe
    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
        $compraExitosa = true; // Variable para verificar si todas las compras se realizan correctamente
        foreach ($_SESSION['carrito'] as $item) {
            $productoId = $item['id_producto']; // Cambia a 'id' según tu estructura
            $cantidad = $item['cantidad'];
            
            // Verifica el stock del producto antes de restarlo
            $producto = $productoModelo->obtenerProductoPorId($productoId); // Asegúrate de tener este método

            // Si el producto no existe o su stock es insuficiente
            if (!$producto || $producto['stock'] < $cantidad) {
                echo "<script>alert('No se puede realizar la compra del producto: {$producto['nombre']}. Stock insuficiente.');
                             window.location.href='../views/index.php';</script>";
                             $_SESSION['carrito'] = '';
                $compraExitosa = false;
                 // Marca la compra como fallida
                break; // Sale del bucle para no procesar más compras
            }
        }

        // Si todos los productos tienen stock suficiente, procede con la compra
        if ($compraExitosa) {
            foreach ($_SESSION['carrito'] as $item) {
                $productoId = $item['id_producto'];
                $cantidad = $item['cantidad'];

                // Resta la cantidad en la base de datos
                $productoModelo->restarStock($productoId, $cantidad);
            }

            // Puedes vaciar el carrito después de la compra
            unset($_SESSION['carrito']);

            // Redirige a una página de éxito o muestra un mensaje
            echo "<script>alert('Compra realizada con éxito');
             window.location.href='../views/index.php';</script>";
        }
    } else {
        echo "<script>alert('El carrito está vacío'); window.location.href='../views/index.php';</script>";
    }
}
?>
