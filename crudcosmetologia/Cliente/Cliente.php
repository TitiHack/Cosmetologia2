<!-- Instrucciones de uso  https://sweetalert.js.org/guides/#installation -->
<script src="../js/sweetalert.js"></script>

<?php
//incluimos la conexion a la base de datos 
include("../Conexion/conexion.php");


//Recibimos las variables enviadas

$txtnombre = (isset($_POST['txtnombre'])) ? $_POST['txtnombre'] : "";
$txtapellido = (isset($_POST['txtapellido'])) ? $_POST['txtapellido'] : "";
$txtdocu_clie = (isset($_POST['txtdocu_clie'])) ? $_POST['txtdocu_clie'] : "";
$txtcontraseña = (isset($_POST['txtcontraseña'])) ? $_POST['txtcontraseña'] : "";
$txtemail = (isset($_POST['txtemail'])) ? $_POST['txtemail'] : "";
$txtcelular = (isset($_POST['txtcelular'])) ? $_POST['txtcelular'] : "";


$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";


switch ($accion) {
    case 'Agregar':

                // Suponiendo que $conn es tu conexión a la base de datos
                    $agregrarCliente = $conn->prepare("INSERT INTO cliente (nombre, apellido, celular, email, contraseña, docu_clie)
                     VALUES (?, ?, ?, ?, ?, ?)");

                    // Verifica si se preparó la consulta correctamente
                    if ($agregrarCliente === false) {
                        die('Error al preparar la consulta: ' . $conn->error);
                    }

                   // Vincula los parámetros a la consulta
                    $agregrarCliente->bind_param("ssssss", $txtnombre, $txtapellido, $txtcelular, $txtemail, $txtcontraseña, $txtdocu_clie);

                    // Ejecuta la consulta
                    $agregrarCliente->execute();

                    // Verifica si hubo errores durante la ejecución
                    if ($agregrarCliente->error) {
                        die('Error al ejecutar la consulta: ' . $agregrarCliente->error);
                    }

                    // Cierra la declaración
                    $agregrarCliente->close();

                /* la variable sentencia recolecta la informacion del formulario y 
                la envia a la base de datos.
                La variable conn nos brinda la conexion a la base de datos.
                ->prepare nos prepara la sentencia SQL para que inyecte los valores a la BD.
                */
                
            break;

    case 'Modificar':

        if (!$editarCliente = $conn->prepare("UPDATE cliente SET nombre = ?, apellido = ?, celular = ?, contraseña = ?, email = ? WHERE docu_clie = ?")) {
            die("Error al preparar la consulta: " . $conn->error);
        }
        
        if (!$editarCliente->bind_param("ssssss", $txtnombre, $txtapellido, $txtcelular, $txtcontraseña, $txtemail, $txtdocu_clie)) {
            die("Error al enlazar parámetros: " . $editarCliente->error);
        }
        
        if (!$editarCliente->execute()) {
            die("Error al ejecutar la consulta: " . $editarCliente->error);
        }
        
        $conn->close();
        header('Location: index.php');
        exit;
        
    case 'Eliminar':
        

        $eliminarCliente = $conn->prepare(" DELETE FROM cliente
        WHERE docu_clie = '$txtdocu_clie' ");

        $eliminarCliente->execute();
        $conn->close();
        header('location: index.php');

       
        break;

    case 'Cancelar':
        header('location: index.php');
        break;

    default:
        # code...
        break;
}


/* Consultamos todos los empleados  */
$consultaCliente = $conn->prepare("SELECT * FROM cliente");
$consultaCliente->execute();
$listaCliente = $consultaCliente->get_result();
$conn->close();
