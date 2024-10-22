<?php
session_start();

// Eliminar todas las variables de sesión
$_SESSION = [];

// Destruir la sesión
session_destroy();

// Redirigir a la página de inicio o a la página de inicio de sesión
header("Location: ../views/inicio-sesion.php");
exit();
?>
