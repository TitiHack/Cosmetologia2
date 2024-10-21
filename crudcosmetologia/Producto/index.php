<?php include 'producto.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>producto</title>
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
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Datos Del producto</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Cuerpo del modal -->
                        <div class="modal-body">

                            <div class="form-row">

                                <label for="txtid_producto">id_producto</label> 
                                <input type="txt" require name="txtid_producto" id="txtid_producto" placeholder="" value="<?php echo $txtid_producto ?>">
                                <!-- <br> -->

                                <div class="form-group col-md-12">
                                    <label for="txtnombreo">nombre</label>
                                    <input type="text" class="form-control" require name="txtnombre" id="txtnombre" placeholder="" value="<?php echo $txtnombre ?>">
                                    <br>
                                </div>


                                <div class="form-group col-md-12">
                                    <label for="txtdescripcion">descripcion</label>
                                    <input type="text" class="form-control" require name="txtdescripcion" id="txtdescripcion" placeholder="" value="<?php echo $txtdescripcion ?>">
                                    <br>
                                </div>


                                <div class="form-group col-md-12">
                                    <label for="txtprecio">precio </label>
                                    <input type="txt" class="form-control" require name="txtprecio" id="txtprecio" placeholder="" value="<?php echo $txtprecio ?>">

                                </div>

                                <div class="form-group col-md-12">
                                    <label for="txtimagen"> imagen </label>
                                    <input type="text" class="form-control" require name="txtimagen" id="txtimagen" placeholder="" value="<?php echo $txtimagen ?>">

                                </div>
                                <div class="form-group col-md-12">
                                    <label for="txtdocu_prov"> documento proveedor </label>
                                    <input type="text" class="form-control" require name="txtdocu_prov" id="txtdocu_prov" placeholder="" value="<?php echo $txtdocu_prov ?>">

                                </div>                                                             

                            </div>
                        </div>

                        <!-- Pie/Footer del modal -->
                        <div class="modal-footer">

                            <input value="Agregar" class="btn btn-success" type="submit" name="accion"></input>
                            <input value="Modificar" class="btn btn-warning" type="submit" name="accion"></input>
                            <input value="Eliminar" class="btn btn-danger" type="submit" name="accion"></input>
                            <input value="Cancelar" class="btn btn-primary" type="submit" name="accion"></input>

                        </div>

                    </div>
                </div>
            </div>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Agregar Producto
            </button>





        </form>
        <!-- Final del Formulario -->


        <div class="row">


            <table class="table table-hover table-bordered">

                <thead class="thead-dark">

                    <tr>
                        <th scope="col">id_producto</th>
                        <th scope="col">nombre</th>
                        <th scope="col">descripcion</th>                      
                        <th scope="col">precio</th>
                        <th scope="col">imagen</th>
                        <th scope="col">docu_prov</th>
                        

                        <th scope="col">Seleccionar</th>
                        <th scope="col">Eliminar</th>
                    </tr>

                </thead>
                <tbody>

                    <?php
                    /* Pregunto que si la variable list Clientes tiene algun contenido */
                    if ($listaProducto->num_rows > 0) {

                        foreach ($listaProducto as  $producto) {


                    ?>

                            <tr>

                                <td> <?php echo  $producto['id_producto']        ?> </td>
                                <td> <?php echo  $producto['nombre']        ?> </td>
                                <td> <?php echo  $producto['descripcion']    ?> </td>
                                <td> <?php echo  $producto['precio'] ?> </td>
                                <td> <?php echo  $producto['imagen'] ?> </td>                                
                                <td> <?php echo  $producto['docu_prov'] ?> </td>
                                
                               


                                <form action="" method="post">

                                    <input type="hidden" name="txtid_producto" value="<?php echo $Producto['id_producto'];  ?>">
                                    <input type="hidden" name="txtnombre" value="<?php echo $Producto['nombre'];  ?>">
                                    <input type="hidden" name="txtdescripcion" value="<?php echo $Producto['descripcion'];  ?>">
                                    <input type="hidden" name="txtprecio" value="<?php echo $Producto['precio'];  ?>">
                                    <input type="hidden" name="txtimagen" value="<?php echo $Producto['imagen'];  ?>">                                    
                                    <input type="hidden" name="txtdocu_prov" value="<?php echo $Producto['docu_prov'];  ?>">
                                    
                                    
                                    

                                    
                                    <td><input value="Eliminar" class="btn btn-danger" type="submit" name="accion"></input></td>

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