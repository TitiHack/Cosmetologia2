<?php include("../Conexion/conexion.php"); ?>
<?php include("proveedor.php"); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedor</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<script>
function confirmarEliminacion(event) {
    event.preventDefault();
    const form = event.target;

    swal({
        title: "¿Estás seguro?",
        text: "No podrás deshacer esta acción",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            form.submit(); // Enviar el formulario si el usuario confirma
        }
    });
}
</script>

<body>
    <div class="container">

        <form action="" method="post" enctype="multipart/form-data">
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Datos Del Proveedor</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="txtemail">Email</label>
                                    <input type="email" class="form-control" required name="txtemail" id="txtemail" value="<?php echo $txtemail; ?>">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="txtdocu_prov">Documento(s)</label>
                                    <input type="text" class="form-control" required name="txtdocu_prov" id="txtdocu_prov" value="<?php echo $txtdocu_prov; ?>">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="txtcelular">Celular</label>
                                    <input type="text" class="form-control" required name="txtcelular" id="txtcelular" value="<?php echo $txtcelular; ?>">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="txtnombre">Nombre(s)</label>
                                    <input type="text" class="form-control" required name="txtnombre" id="txtnombre" value="<?php echo $txtnombre; ?>">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="txtapellido">Apellido</label>
                                    <input type="text" class="form-control" required name="txtapellido" id="txtapellido" value="<?php echo $txtapellido; ?>">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="txtcontraseña">Contraseña</label>
                                    <input type="password" class="form-control" required name="txtcontraseña" id="txtcontraseña" value="<?php echo $txtcontraseña; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input value="Agregar" class="btn btn-success" type="submit" name="accion">
                            <input value="Modificar" class="btn btn-warning" type="submit" name="accion">
                            <input value="Cancelar" class="btn btn-primary" type="button" data-bs-dismiss="modal">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Agregar Proveedor</button>
        </form>

        <div class="row">
            <table class="table table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Email</th>
                        <th scope="col">Documento</th>
                        <th scope="col">Celular</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Contraseña</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $consultaProveedor = "SELECT * FROM proveedor";
                    $resultadoProveedor = $conn->query($consultaProveedor);

                    if ($resultadoProveedor === false) {
                        echo "<tr><td colspan='7'>Error en la consulta: " . $conn->error . "</td></tr>";
                    } else {
                        $listaProveedor = [];
                        if ($resultadoProveedor->num_rows > 0) {
                            while ($fila = $resultadoProveedor->fetch_assoc()) {
                                $listaProveedor[] = $fila;
                            }
                        }
                        
                        if (count($listaProveedor) > 0) {
                            foreach ($listaProveedor as $Proveedor) {
                    ?>
                                <tr>
                                    <td><?php echo $Proveedor['email']; ?></td>
                                    <td><?php echo $Proveedor['docu_prov']; ?></td>
                                    <td><?php echo $Proveedor['celular']; ?></td>
                                    <td><?php echo $Proveedor['nombre']; ?></td>
                                    <td><?php echo $Proveedor['apellido']; ?></td>
                                    <td><?php echo $Proveedor['contraseña']; ?></td>
                                    <td>
                                        <form action="proveedor.php" method="post" onsubmit="confirmarEliminacion(event)">
                                            <input type="hidden" name="txtdocu_prov" value="<?php echo $Proveedor['docu_prov']; ?>">
                                            <input type="hidden" name="accion" value="Eliminar">

                                            <input type="submit" value="Eliminar" class="btn btn-danger">
                                        </form>
                                    </td>
                                </tr>
                    <?php
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center'>No hay proveedores registrados.</td></tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/sweetalert.js"></script>
</body>
</html>
