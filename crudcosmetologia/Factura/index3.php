<?php include 'Factura.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <!-- link Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">



</head>

<body>
    <div class="container">

        <!-- enctype="multipart/form-data" se utiliza para tratar la fotografia -->
        <form action="" method="post" enctype="multipart/form-data">



            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- cabecera del modal -->
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Datos De la Factura</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Cuerpo del modal -->
                        <div class="modal-body">

                            <div class="form-row">

                                <label for="txtid_Factura">id_factura</label> 
                                <input type="txt" require name="txtid_Factura" id="txtid_Factura" placeholder="" value="<?php echo $txtid_Factura ?>">
                                <!-- <br> -->

                                <div class="form-group col-md-12">
                                    <label for="txtid_vendedor">id_vendedor </label>
                                    <input type="text" class="form-control" require name="txtid_vendedor" id="txtid_vendedor" placeholder="" value="<?php echo $txtid_vendedor ?>">
                                    <br>
                                </div>


                                <div class="form-group col-md-12">
                                    <label for="txtid_cliente">id</label>
                                    <input type="text" class="form-control" require name="txtid_cliente" id="txtid_cliente" placeholder="" value="<?php echo $txtid_cliente ?>">
                                    <br>
                                </div>


                               

                                



                            </div>
                        </div>

                        <!-- Pie/Footer del modal -->
                        <div class="modal-footer">

                            <button value="btnAgregar" class="btn btn-success" type="submit" name="accion">Agregar</button>
                            <button value="btnModificar" class="btn btn-warning" type="submit" name="accion">Modificar</button>
                            <button value="btnEliminar" class="btn btn-danger" type="submit" name="accion">Eliminar</button>
                            <button value="btnCancelar" class="btn btn-primary" type="submit" name="accion">Cancelar</button>

                        </div>

                    </div>
                </div>
            </div>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Agregar Factura
            </button>





        </form>
        <!-- Final del Formulario -->


        <div class="row">


            <table class="table table-hover table-bordered">

                <thead class="thead-dark">

                    <tr>
                        <th scope="col">id_factura</th>
                        <th scope="col">id_vendedor</th>
                        <th scope="col">id_cliente</th>
                        
                        

                        <th scope="col">Seleccionar</th>
                        <th scope="col">Eliminar</th>
                    </tr>

                </thead>
                <tbody>

                    <?php
                    /* Pregunto que si la variable list Clientes tiene algun contenido */
                    if ($listaProducto->num_rows > 0) {

                        foreach ($listaProducto as  $Factura) {


                    ?>

                            <tr>

                                <td> <?php echo  $Factura['id_factura']        ?> </td>
                                <td> <?php echo  $Factura['id_vendedor']        ?> </td>
                                <td> <?php echo  $Factura['id_cliente']    ?> </td>
                                
                               


                                <form action="" method="post">

                                    <input type="hidden" name="txtid_factura" value="<?php echo $Factura['id_factura'];  ?>">
                                    <input type="hidden" name="txtid_vendedor" value="<?php echo $Factura['id_vendedor'];  ?>">
                                    <input type="hidden" name="txtid_cliente" value="<?php echo $Factura['id_cliente'];  ?>">
                                   
                                    

                                    <td><input type="submit" class="btn btn-info" value="Seleccionar"></td>
                                    <td><button value="btnEliminar" class="btn btn-danger" type="submit" name="accion">Eliminar</button></td>

                                </form>


                            </tr>


                    <?php

                        }
                    } else {

                        echo "<h2> No tenemos resultados </h2>";
                    }

                    ?>


                </tbody>
            </table>

        </div>

    </div>




    <!-- link Bootstrap JS -->
    <script src="../js/bootstrap.bundle.min.js"></script>

    <!-- Instrucciones de uso  https://sweetalert.js.org/guides/#installation -->
    <script src="../js/sweetalert.js"></script>

    <!-- <script>
        swal("Mensaje Principal!", "Mensaje segundario!", "success");
    </script> -->

</body>

</html>