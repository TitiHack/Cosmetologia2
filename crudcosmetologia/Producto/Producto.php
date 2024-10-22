<!-- Instrucciones de uso  https://sweetalert.js.org/guides/#installation -->
<script src="../js/sweetalert.js"></script>

<?php
//incluimos la conexion a la base de datos 
include("../Conexion/conexion.php");


//Recibimos las variables enviadas
$txtid_producto = (isset($_POST['txtid_producto'])) ? $_POST['txtid_producto'] : "";
$txtnombre = (isset($_POST['txtnombre'])) ? $_POST['txtnombre'] : "";
$txtdescripcion_producto = (isset($_POST['txtdescripcion_producto'])) ? $_POST['txtdescripcion_producto'] : "";
$txtprecio_producto = (isset($_POST['txtprecio_producto'])) ? $_POST['txtprecio_producto'] : "";
$txtid_clientes = (isset($_POST['txtid_clientes'])) ? $_POST['txtid_clientes'] : "";
$imagen = (isset($_POST['imagen'])) ? $_POST['imagen'] : "";



$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";


switch ($accion) {
    case 'btnAgregar':


                /* la variable sentencia recolecta la informacion del formulario y 
                la envia a la base de datos.
                La variable conn nos brinda la conexion a la base de datos.
                ->prepare nos prepara la sentencia SQL para que inyecte los valores a la BD.
                */
                $insercionProducto = $conn->prepare(
                    "INSERT INTO producto (id_producto, nombre_producto, descripcion_producto, precio_producto,  id_clientes, id_vendedor, id_factura) 
                VALUES ('$txtid_producto', '$txtnombre' , '$txtdescripcion_producto', '$txtprecio_producto', '$txtid_clientes', '$txtid_vendedor', '$txtid_factura')");


                $insercionProducto->execute();
                $conn->close();
                header('location: index.php');
               
            break;

    case 'btnModificar':

        $editarProducto = $conn->prepare(" UPDATE producto SET nombre_producto = '$txtnombre', descripcion_producto = '$txtdescripcion_producto', precio_producto = '$txtprecio_producto', id_factura = '$txtid_factura', id_clientes = '$txtid_clientes', id_vendedor  = '$txtid_vendedor'
        WHERE id_producto = '$txtid_producto' ");

        
        $editarProducto->execute();
        $conn->close();

        header('location: index.php');

        break;

    case 'btnEliminar':
        

        $eliminarProducto = $conn->prepare(" DELETE FROM producto
        WHERE id_producto = '$txtid_producto' ");

        $eliminarProducto->execute();
        $conn->close();
        header('location: index.php');

       
        break;

    case 'btnCancelar':
        header('location: index.php');
        break;

    default:
        # code...
        break;
}


/* Consultamos todos los empleados  */
$consultaProducto = $conn->prepare("SELECT * FROM producto");
$consultaProducto->execute();
$listaProducto = $consultaProducto->get_result();
$conn->close();
