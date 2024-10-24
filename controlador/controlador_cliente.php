<?php
include_once '../Conexion/conexion.php';
include_once '../models/ClienteModelo.php';

$cliente = new Cliente($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    
    if (isset($_POST['accion'])) {
        $accion = $_POST['accion'];

        // Crear un nuevo cliente
        if ($accion === 'crear') {
            $docu_clie = $_POST['docu_clie'];
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $contrasena = $_POST['contraseña']; 
            $apellido = $_POST['apellido'];
            $celular = $_POST['celular'];
            $cliente->crear($docu_clie, $nombre, $email, $contrasena,$celular,$apellido);
            echo "Cliente creado con éxito";
            header("Location: ../views/Clientecrud.php");

        }elseif ($accion === 'crearcliente') {
                $docu_clie = $_POST['docu_clie'];
                $nombre = $_POST['nombre'];
                $email = $_POST['email'];
                $contrasena = $_POST['contraseña']; 
                $apellido = $_POST['apellido'];
                $celular = $_POST['celular'];
                $cliente->crear($docu_clie, $nombre, $email, $contrasena,$celular,$apellido);
                echo "Cliente creado con éxito";
                header("Location: ../views/registro.php");
                
        // Actualizar un cliente
        } elseif ($accion === 'actualizar') {
            $docu_clie = $_POST['docu_clie'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $contrasena = $_POST['contraseña'];
            $email = $_POST['email'];
            $celular = $_POST['celular'];
            $cliente->actualizar($docu_clie, $nombre, $email, $apellido, $celular, $contrasena);
            header("Location: ../views/Clientecrud.php");
        // Eliminar un cliente
        } elseif ($accion === 'eliminar') {
            $docu_clie = $_POST['docu_clie'];
            $cliente->eliminar($docu_clie);
            echo "Cliente eliminado con éxito";

        // Iniciar sesión
        } elseif ($accion === 'iniciar_sesion') {

            $docu_clie = $_POST['docu_clie'];
            $contrasena = $_POST['contraseña'];
         
            $clienteInfo = $cliente->iniciarSesion($docu_clie, $contrasena);
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

// Obtener un cliente por docu_clie
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['docu_clie'])) {
        $docu_clie = $_GET['docu_clie'];
        $clienteInfo = $cliente->obtenerPorDocumento($docu_clie);
        echo json_encode($clienteInfo);

    // Obtener todos los clientes
    } else {
        $todosClientes = $cliente->obtenerTodos();
        json_encode($todosClientes);
    }
}
?>
