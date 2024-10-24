<?php
// Asegúrate de incluir el archivo de conexión y el modelo de productos
session_start();

include_once '../Conexion/conexion.php';
include_once '../models/ProductoModelo.php';

$producto = new Producto($conn);
$todosProductos = $producto->obtenerTodos(); // Obtiene todos los productos
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cosmetologia</title>
    <link rel="stylesheet" href="../public/css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Playwrite+CU:wght@100..400&display=swap" rel="stylesheet">
</head>
<body>

    <header>
        <div class="headerOne"></div>
        <div class="headerTwo">
            <img src="../public/images/logo2.jpeg" id="logo" alt="">
            <h1>Cosmetologia Ilusion Y Belleza</h1>          
            <div class="header2"></div>
            <div class="icons">
            <?php if (isset($_SESSION['cliente'])  ): ?>
                <button><a href="../views/admin.php">Administrar</a></button>
            <?php endif; ?>
                <button><a href="../views/nuevo.php">Nuevo</a></button>
                <a href="./carrito.php">                <img src="../public/images/carro-de-la-compra.png" alt="">
                </a>
                <?php if (!isset($_SESSION['']) /*&& $_SESSION['rol']*/ ): ?>
                    <a href="../views/perfil.php"><img src="../public/images/avatar.png" alt=""></a> 

            <?php endif; ?>
            </div>
        </div>
    </header>

    <main>
        <div class="menu">
            <p><a href="../views/index.php">Inicio</a></p>
            <p><a href="../views/servicios.php">Servicios</a></p>
            <p><a href="../views/productos.php">Productos</a></p>
            <p><a href="../views/acercade.php">Acerca de</a></p>
        </div>

        <div class="slide">
    <?php foreach ($todosProductos as $producto): ?>
    <div class="tarjeta">
        <div class="div-tarjet-img">
            <img src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>">
        </div>
        <h2 class="nameProduct"><?php echo $producto['nombre']; ?></h2>
        
        <div class="category">
            <p class="SpaceP">Categoria: </p>
            <p><?php echo $producto['categoria']; ?></p>
        </div>
        <div class="price">
            <p class="SpaceP">Precio: </p>
            <p class="precio"><?php echo number_format($producto['precio'], 0, ',', '.'); ?>$</p>
        </div>
        <div class="category">
            <p class="SpaceP">Stock: </p>
            <p><?php echo $producto['stock']; ?></p>
        </div>
        <form method="POST" action="../controlador/agregarCarrito.php">
            <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
            <input type="hidden" name="nombre" value="<?php echo $producto['nombre']; ?>">
            <input type="hidden" name="precio" value="<?php echo $producto['precio']; ?>">
            <input type="hidden" name="imagen" value="<?php echo $producto['imagen']; ?>">
            <button type="submit">Agregar al carrito</button>
        </form>
    </div>
    <?php endforeach; ?>
</div>
                
    </main>

    <footer>
        <p>Correo: cosmetologiawmcj@gmail.com</p>
        <p>Telefono: 3186882571</p>

        </footer>

</body>
</html>
