<?php
// Asegúrate de incluir el archivo de conexión y el modelo de productos
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
                <button><a href="../views/nuevo.php">Nuevo</a></button>
                <img src="../public/images/carro-de-la-compra.png" alt="">
                <a href="../views/registro.php"><img src="../public/images/avatar.png" alt=""></a>
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
            <div class="tarjet-container">
                <?php foreach ($todosProductos as $producto): ?>
                <div class="tarjet">
                    <div class="div-tarjet-img">
                        <img src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>">
                    </div>
                    <h2><?php echo $producto['nombre']; ?></h2>             
                    <p class="precio"><?php echo number_format($producto['precio'], 2, ',', '.'); ?>$</p>
                    <p><?php echo $producto['categoria']; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        
    </main>

    <footer>
        <p>Correo: cosmetologiawmcj@gmail.com</p>
        <p>Telefono: 3123211</p>

        <div>
            <img src="../public/images/bxl-whatsapp.svg" alt="">
            <img src="../public/images/bxl-instagram.svg" alt="">
        </div>
    </footer>

</body>
</html>
