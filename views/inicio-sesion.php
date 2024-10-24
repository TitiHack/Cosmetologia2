<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="../public/css/styles-inicio-sesion.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Playwrite+CU:wght@100..400&display=swap"
        rel="stylesheet">
</head>

<body>
    <header>
        <h2>Iniciar Sesión</h2>
        <nav>
            <li><a href="../views/index.php">Inicio</a></li>
            <li><a href="../views/registro.php">Registrarse</a></li>
            <li><a href="../views/acercade.php">Acerca de</a></li>
        </nav>
    </header>

    <div class="container">
        <div class="mitad1">
            <img src="../public/images/logo2.jpeg" alt="">
        </div>
        <div class="contenido">
            <form action="../controlador/controlador_cliente.php" method="post">
                <div class="contItems">
                    <div class="alineado">
                        <h3>Documento:</h3>
                        <input type="text" name="docu_clie" required>
                    </div>
                    <div class="alineado">
                        <h3>Contraseña:</h3>
                        <input type="password" name="contraseña" required>
                    </div>
                </div>

                <input type="hidden" name="accion" value="iniciar_sesion">
                <input type="submit" name="iniciar" value="Iniciar Sesión">
            </form>    
        </div>
    </div>
</body>

</html>
