<?php include 'Cliente.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">



</head>

<body>
    <div class="container">

        <form action="" method="post" enctype="multipart/form-data">



            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Datos Del Cliente</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">

                            <div class="form-row">

                                <div class="form-group col-md-12">
                                    <label for="txtemail">email</label>
                                    <input type="email" class="form-control" require name="txtemail" id="txtemail" placeholder="" value="<?php echo $txtemail ?>">
                                    <br>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="txtdocu_clie">documento(s)</label>
                                    <input type="text" class="form-control" require name="txtdocu_clie" id="txtdocu_clie" placeholder="" value="<?php echo $txtdocu_clie ?>">
                                    <br>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="txtcelular"> celular </label>
                                    <input type="txt" class="form-control" require name="txtcelular" id="txtcelular" placeholder="" value="<?php echo $txtcelular ?>">

                                </div>

                                <div class="form-group col-md-12">
                                    <label for="txtnombre">Nombre(s)</label>
                                    <input type="text" class="form-control" require name="txtnombre" id="txtnombre" placeholder="" value="<?php echo $txtnombre ?>">
                                    <br>
                                </div>


                                <div class="form-group col-md-12">
                                    <label for="txtapellido">apellido </label>
                                    <input type="text" class="form-control" require name="txtapellido" id="txtapellido" placeholder="" value="<?php echo $txtapellido ?>">

                                </div>

                               
                                <div class="form-group col-md-12">
                                    <label for="txtcontraseña"> contraseña </label>
                                    <input type="text" class="form-control" require name="txtcontraseña" id="txtcontraseña" placeholder="" value="<?php echo $txtcontraseña ?>">

                                </div>

                                

                                
                               
                                


                            </div>
                        </div>

                        <!-- Pie/Footer del modal -->
                        <div class="modal-footer">

                            <input value="Agregar" class="btn btn-success" type="submit" name="accion"></input>
                            <input value="Modificar" class="btn btn-warning" type="submit" name="accion"></input>
                            <input value="Cancelar" class="btn btn-primary" type="submit" name="accion"></input>

                        </div>

                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Agregar Cliente
            </button>





        </form>
        <!-- Final del Formulario -->


        <div class="row">


            <table class="table table-hover table-bordered">

                <thead class="thead-dark">

                    <tr>
                        <th scope="col">Email</th>
                        <th scope="col">Documento</th>
                        <th scope="col">Celular</th>
                        <th scope="col">Nombres</th>
                        <th scope="col">Apellido</th>                      
                        <th scope="col">Contraseña</th>
                        
                        

                        

                        
                        <th scope="col">Eliminar</th>
                    </tr>

                </thead>
                <tbody>

                    <?php

                    if ($listaCliente->num_rows > 0) {

                        foreach ($listaCliente as  $Cliente) {


                    ?>

                            <tr>

                                <td> <?php echo  $Cliente['email']    ?> </td>
                                <td> <?php echo  $Cliente['docu_clie']        ?> </td>
                                <td> <?php echo  $Cliente['celular'] ?> </td>                                
                                <td> <?php echo  $Cliente['nombre']    ?> </td>
                                <td> <?php echo  $Cliente['apellido'] ?> </td>
                                <td> <?php echo  $Cliente['contraseña'] ?> </td>
                                
                                




                                <form action="" method="post">

                                    <input type="hidden" name="txtemail" value="<?php echo $Cliente['email'];  ?>">
                                    <input type="hidden" name="txtdocu_clie" value="<?php echo $Cliente['docu_clie'];  ?>">                                    
                                    <input type="hidden" name="txtcelular" value="<?php echo $Cliente['celular'];  ?>">
                                    <input type="hidden" name="txtnombre" value="<?php echo $Cliente['nombre'];  ?>">
                                    <input type="hidden" name="txtapellido" value="<?php echo $Cliente['apellido'];  ?>">                                    
                                    <input type="hidden" name="txtcontraseña" value="<?php echo $Cliente['contraseña'];  ?>">
                                    
                                    
                                    

                                    
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