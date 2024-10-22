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

    <div class="container">
        <h2>Información del Cliente</h2>
        <table>
            <tr>
                <th>Documento</th>
                <td><?php echo htmlspecialchars($cliente['docu_clie']); ?></td>
            </tr>
            <tr>
                <th>Nombre</th>
                <td><?php echo htmlspecialchars($cliente['nombre']); ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo htmlspecialchars($cliente['email']); ?></td>
            </tr>
            <!-- Aquí puedes añadir más campos si es necesario -->
        </table>
    </div>

</body>
</html>
