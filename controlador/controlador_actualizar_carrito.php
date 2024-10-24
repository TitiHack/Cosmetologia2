<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];

    // Recorre los productos en el carrito
    foreach ($_POST['productos'] as $producto) {
        $id = $producto['id'];
        $cantidad = $producto['cantidad'];

        // Verifica si el producto ya existe en el carrito y actualiza la cantidad
        foreach ($carrito as &$item) {
            if ($item['id'] == $id) {
                $item['cantidad'] = $cantidad;
                break;
            }
        }
    }

    // Guarda el carrito actualizado en la sesión
    $_SESSION['carrito'] = $carrito;

    // Redirige al carrito de compras
    header('Location: ../views/carrito.php');
    exit();
}
?>
