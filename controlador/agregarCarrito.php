<?php
session_start();

// Verificar si el carrito ya existe en la sesión
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Verificar si se ha enviado un producto para agregar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_producto'])) {
    // Obtener los datos del producto
    $producto = [
        'id_producto' => $_POST['id_producto'],
        'nombre' => $_POST['nombre'],
        'precio' => $_POST['precio'],
        'imagen' => $_POST['imagen'],
        'cantidad' => 1 // Puedes ajustar la cantidad según tus necesidades
    ];

    // Verificar si el producto ya está en el carrito
    $encontrado = false;
    foreach ($_SESSION['carrito'] as &$item) {
        if ($item['id_producto'] === $producto['id_producto']) {
            $item['cantidad']++; // Aumentar la cantidad si ya está en el carrito
            $encontrado = true;
            break;
        }
    }

    // Si no se encuentra, agregar el nuevo producto al carrito
    if (!$encontrado) {
        $_SESSION['carrito'][] = $producto;
    }

    // Redirigir de vuelta a la página de productos o a donde quieras
    header("Location: ../views/index.php");
    exit();
}
?>
