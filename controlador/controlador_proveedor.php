<?php
include_once '../Conexion/conexion.php';
include_once '../models/ProveedorModelo.php';

$proveedor = new Proveedor($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    
    if (isset($_POST['accion'])) {
        $accion = $_POST['accion'];

        // Crear un nuevo proveedor
        if ($accion === 'crear') {
            $docu_prov = $_POST['docu_prov'];
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $contrasena = $_POST['contraseña']; 
            $apellido = $_POST['apellido'];
            $celular = $_POST['celular'];
            $proveedor->crear($docu_prov, $nombre, $email, $contrasena,$celular,$apellido);
            echo "proveedor creado con éxito";
            
        // Actualizar un proveedor
        } elseif ($accion === 'actualizar') {
            $docu_prov = $_POST['docu_prov'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $contrasena = $_POST['contraseña'];
            $email = $_POST['email'];
            $celular = $_POST['celular'];
            $proveedor->actualizar($docu_prov, $nombre, $email, $apellido, $celular, $contrasena);

        // Eliminar un proveedor
        } elseif ($accion === 'eliminar') {
            $docu_prov = $_POST['docu_prov'];
            $proveedor->eliminar($docu_prov);
            echo "proveedor eliminado con éxito";

        // Iniciar sesión
        } elseif ($accion === 'iniciar_sesion') {

            $docu_prov = $_POST['docu_prov'];
            $contrasena = $_POST['contraseña'];
         
            $proveedorInfo = $proveedor->iniciarSesion($docu_prov, $contrasena);
            if ($proveedorInfo) {
                session_start();

                // Guardar información del proveedor en la sesión
                $_SESSION['proveedor'] = $proveedorInfo;
                // Redireccionar a la página deseada después del inicio de sesión
                header("Location: ../views/index.php");
                exit();
            } else {
                echo "Documento o contraseña incorrectos";
            }
        
        }
    }
}

// Obtener un proveedor por docu_prov
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['docu_prov'])) {
        $docu_prov = $_GET['docu_prov'];
        $proveedorInfo = $proveedor->obtenerPorDocumento($docu_prov);
        echo json_encode($proveedorInfo);

    // Obtener todos los proveedor
    } else {
        $todosProveedor = $proveedor->obtenerTodos();
        echo json_encode($todosProveedor);
    }
}
?>
