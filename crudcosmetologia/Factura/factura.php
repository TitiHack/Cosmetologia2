<!-- Instrucciones de uso  https://sweetalert.js.org/guides/#installation -->
<script src="../js/sweetalert.js"></script>

<?php
//incluimos la conexion a la base de datos 
include("../Conexion/conexion.php");


//Recibimos las variables enviadas
$txtid_factura = (isset($_POST['txtid_factura'])) ? $_POST['txtid_factura'] : "";
$txtid_clientes = (isset($_POST['txtid_clientes'])) ? $_POST['txtid_clientes'] : "";
$txtid_vendedor = (isset($_POST['txtidetxtid_vendedor'])) ? $_POST[' txtid_vendedor'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";


switch ($accion) {
    case 'btnAgregar':


                /* la variable sentencia recolecta la informacion del formulario y 
                la envia a la base de datos.
                La variable conn nos brinda la conexion a la base de datos.
                ->prepare nos prepara la sentencia SQL para que inyecte los valores a la BD.
                */
                $insercionFactura = $conn->prepare(
                    "INSERT INTO factura (id_factura, id_clientes,  id_vendedor) 
                VALUES ('$txtid_factura', '$txtid_cliente' , '$txtid_vendedor')");


                $insercionFactura->execute();
                $conn->close();
                header('location: index3.php');
               
            break;

    case 'btnModificar':

        $editarFactura = $conn->prepare(" UPDATE factura SET id_factura = '$txtid_factura',  id_vendedor = '$txtid_vendedor', id_cliente = '$txtid_cliente
        WHERE id_factura = '$txtid_factura' ");

        
        $editarFactura->execute();
        $conn->close();

        header('location: index3.php');

        break;

    case 'btnEliminar':
        

        $eliminarFactura = $conn->prepare(" DELETE FROM factura
        WHERE id_Factura = '$txtid_Factura' ");

        $eliminarFactura->execute();
        $conn->close();
        header('location: index3.php');

       
        break;

    case 'btnCancelar':
        header('location: index3.php');
        break;

    default:
        # code...
        break;
}


/* Consultamos todos los empleados  */
$consultaFactura = $conn->prepare("SELECT * FROM factura");
$consultaFactura->execute();
$listaFactura = $consultaFactura->get_result();
$conn->close();
