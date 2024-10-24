<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['cliente'])) {
    header("Location: ../views/inicio-sesion.php"); // Redirigir si no está autenticado
    exit();
}

// Obtener la información del cliente de la sesión
$cliente = $_SESSION['cliente'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Playwrite+CU:wght@100..400&display=swap" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil del Usuario</title>
    <link rel="stylesheet" href="../public/css/styles-perfil.css"> <!-- Enlaza tu CSS -->
</head>
<body>
    <header>
        <h1>Perfil del Usuario</h1>
        <nav>
            <li><a href="../views/index.php">Inicio</a></li>
            <li><a href="../views/registro.php">Registrarse</a></li>
            <li><a href="../views/acercade.php">Acerca de</a></li>
            <li><a href="../controlador/controlador_cerrar_sesion.php">Cerrar Sesión</a></li>
        </nav>
    </header>
<main>  
      <div class="container shadow p-3 mb-5 bg-white rounded">
        <h2>Información de la cuenta</h2>
        <div class="tabla">
            <div class="item">
                <h4>Documento:</h4>
                <p><?php echo htmlspecialchars($cliente['docu_clie']); ?></p>
</div>
            <div class="item">
                <h4>Nombre:</h4>
                <p><?php echo htmlspecialchars($cliente['nombre']); ?></p>
</div>
            <div class="item">
                <h4 class="">Email:</h4>
                <p><?php echo htmlspecialchars($cliente['email']); ?></p>
</div>
            <!-- Aquí puedes añadir más campos si es necesario -->
</div>
        <button class="btn btn-success">Actualizar</button>
    </div>
    </main>

</body>
</html>
