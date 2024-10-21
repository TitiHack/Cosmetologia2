<?php
include_once '../Conexion/conexion.php';
include_once '../models/ClienteModelo.php';

$cliente = new Cliente($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    
    if (isset($_POST['accion'])) {
        $accion = $_POST['accion'];

        // Crear un nuevo cliente
        if ($accion === 'crear') {
            $documento = $_POST['documento'];
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $contrasena = $_POST['contrasena']; 
            $apellido = $_POST['apellido'];
            $celular = $_POST['celular'];
            $cliente->crear($documento, $nombre, $email, $contrasena,$celular,$apellido);
            echo "Cliente creado con éxito";

        // Actualizar un cliente
        } elseif ($accion === 'actualizar') {
            $documento = $_POST['documento'];
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $cliente->actualizar($documento, $nombre, $email);
            echo "Cliente actualizado con éxito";

        // Eliminar un cliente
        } elseif ($accion === 'eliminar') {
            $documento = $_POST['documento'];
            $cliente->eliminar($documento);
            echo "Cliente eliminado con éxito";

        // Iniciar sesión
        } elseif ($accion === 'iniciar_sesion') {
            $documento = $_POST['documento'];
            $contrasena = $_POST['contrasena'];
    
            $clienteInfo = $cliente->iniciarSesion($documento, $contrasena);
            if ($clienteInfo) {
                session_start();

                // Guardar información del cliente en la sesión
                $_SESSION['cliente'] = $clienteInfo;
                // Redireccionar a la página deseada después del inicio de sesión
                header("Location: ../views/index.php");
                exit();
            } else {
                echo "Documento o contraseña incorrectos";
            }
        
        }
    }
}

// Obtener un cliente por documento
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['documento'])) {
        $documento = $_GET['documento'];
        $clienteInfo = $cliente->obtenerPorDocumento($documento);
        echo json_encode($clienteInfo);

    // Obtener todos los clientes
    } else {
        $todosClientes = $cliente->obtenerTodos();
        echo json_encode($todosClientes);
    }
}
?>
