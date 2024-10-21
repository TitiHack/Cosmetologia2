<!-- Incluir SweetAlert -->
<script src="../js/sweetalert.js"></script>

<?php
// Incluir la conexión a la base de datos 
include("../Conexion/conexion.php");

// Verificar si se ha enviado un formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir las variables enviadas
    $txtnombre = $_POST['txtnombre'] ?? "";
    $txtapellido = $_POST['txtapellido'] ?? "";
    $txtdocu_prov = $_POST['txtdocu_prov'] ?? "";
    $txtcontraseña = $_POST['txtcontraseña'] ?? "";
    $txtemail = $_POST['txtemail'] ?? "";
    $txtcelular = $_POST['txtcelular'] ?? "";
    $accion = $_POST['accion'] ?? "";

    switch ($accion) {
        case 'Agregar':
            agregarProveedor($conn, $txtnombre, $txtapellido, $txtcelular, $txtemail, $txtcontraseña, $txtdocu_prov);
            break;

        case 'Modificar':
            modificarProveedor($conn, $txtnombre, $txtapellido, $txtcelular, $txtcontraseña, $txtemail, $txtdocu_prov);
            break;

        case 'Eliminar':
            eliminarProveedor($conn, $txtdocu_prov);
            break;

        case 'Cancelar':
            header('location: index.php');
            exit;

        default:
            break;
    }
}

function agregarProveedor($conn, $nombre, $apellido, $celular, $email, $contraseña, $docu_prov) {
    $agregarProveedor = $conn->prepare("INSERT INTO proveedor (nombre, apellido, celular, email, contraseña, docu_prov) VALUES (?, ?, ?, ?, ?, ?)");
    
    if ($agregarProveedor === false) {
        die('Error al preparar la consulta: ' . $conn->error);
    }

    $agregarProveedor->bind_param("ssssss", $nombre, $apellido, $celular, $email, $contraseña, $docu_prov);
    
    if (!$agregarProveedor->execute()) {
        die('Error al ejecutar la consulta: ' . $agregarProveedor->error);
    }

    $agregarProveedor->close();
    header('Location: index.php'); // Redirigir después de agregar
    exit;
}

function modificarProveedor($conn, $nombre, $apellido, $celular, $contraseña, $email, $docu_prov) {
    $editarProveedor = $conn->prepare("UPDATE proveedor SET nombre = ?, apellido = ?, celular = ?, contraseña = ?, email = ? WHERE docu_prov = ?");
    
    if ($editarProveedor === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    $editarProveedor->bind_param("ssssss", $nombre, $apellido, $celular, $contraseña, $email, $docu_prov);
    
    if (!$editarProveedor->execute()) {
        die("Error al ejecutar la consulta: " . $editarProveedor->error);
    }

    $editarProveedor->close();
    header('Location: index.php'); // Redirigir después de modificar
    exit;
}

function eliminarProveedor($conn, $docu_prov) {
    $eliminarProveedor = $conn->prepare("DELETE FROM proveedor WHERE docu_prov = ?");
    
    if ($eliminarProveedor === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    $eliminarProveedor->bind_param("s", $docu_prov);
    
    if ($eliminarProveedor->execute()) {
        echo "<script>
        document.addEventListener('DOMContentLoaded', function () {
    swal('Proveedor eliminado!', 'El proveedor ha sido eliminado correctamente.', 'success').then(() => {
        window.location.href = 'index.php'; // Redirige a index.php
    });
});
</script>";

    } else {
        echo "<script>swal('Error al eliminar el proveedor.', '', 'error');</script>";
    }

    $eliminarProveedor->close();
    $conn->close();
}

?>