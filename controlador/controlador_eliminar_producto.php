<?php
session_start();

if (isset($_GET['id'])) {
    $productoId = $_GET['id'];
    $carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];

    // Filtra el carrito para eliminar el producto con el ID especificado
    $_SESSION['carrito'] = array_filter($carrito, function($item) use ($productoId) {
        return $item['id'] != $productoId;
    });

    // Redirige al carrito de compras
    header('Location: ../views/carrito.php');
    exit();
}
?>
