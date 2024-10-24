<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['proveedor']) && !isset($_SESSION['cliente'])) {
    header("Location: ../views/inicio-sesion.php"); // Redirigir si no está autenticado
    exit();
}

// Inicializar la variable $user
$user = null;

// Obtener la información del usuario de la sesión
if (isset($_SESSION['proveedor'])) {
    $user = $_SESSION['proveedor'];
} elseif (isset($_SESSION['cliente'])) {
    $user = $_SESSION['cliente'];
}

// Asegurarse de que $user no sea nulo antes de mostrar
if ($user === null) {
    // Si por alguna razón $user es null, puedes manejarlo aquí
    echo "Error: No se encontró información del usuario.";
    exit();
}
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
            <ul>
                <li><a href="../views/index.php">Inicio</a></li>
                <li><a href="../views/acercade.php">Acerca de</a></li>
                <li><a href="../controlador/controlador_cerrar_sesion.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>
    <main>  
        <div class="container shadow p-3 mb-5 bg-white rounded">
            <h2>Información de la cuenta</h2>
            <div class="tabla">
                <div class="item">
                    <h4>Documento:</h4>
                    <p><?php echo htmlspecialchars(isset($user['docu_prov']) ? $user['docu_prov'] : $user['docu_clie']); ?></p>
                </div>
                <div class="item">
                    <h4>Nombre:</h4>
                    <p><?php echo htmlspecialchars($user['nombre']); ?></p>
                </div>
                <div class="item">
                    <h4>Apellido:</h4>
                    <p><?php echo htmlspecialchars($user['apellido']); ?></p>
                </div>
                <div class="item">
                    <h4>Email:</h4>
                    <p><?php echo htmlspecialchars($user['email']); ?></p>
                </div>
                <div class="item">
                    <h4>Celular:</h4>
                    <p><?php echo htmlspecialchars($user['celular']); ?></p>
                </div>
                
            </div>
        </div>
    </main>
</body>
</html>
