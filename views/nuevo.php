<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo</title>
    <link rel="stylesheet" href="../public/css/styles-nuevo.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<link href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Playwrite+CU:wght@100..400&display=swap" rel="stylesheet">
</head>
<body>

    <header>

        <div class="headerOne"></div>

        <div class="headerTwo">
                <img src="../public/images/logo2.jpeg" id="logo" alt="">
                <h1>Cosmetologia Ilusion Y Belleza</h1>          
                <div class="header2">
                    
                </div>
                <div class="icons">
                    
                    <img src="../public//images/carro-de-la-compra.png" alt="">
                    <a href="../views/registro.php"><img src="../public/images/avatar.png" alt=""></a>
                </div>
            </div>
        </div>
           
        
    </header>
    <main>
        <div class="menu">
            <p><a style="color:white;" href="../views/index.php">Inicio</a></p>
            <p><a style="color:white;" href="../views/servicios.php">Servicios</a></p>
            <p><a style="color:white;" href="../views/productos.php">Productos</a></p>
            <p><a style="color:white;"href="../views/acercade.php">Acerca de</a></p>
        </div>

        <div class="slide">
            

            <div class="contenido">           
                      
                <form action="../controlador/controlador_producto.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="accion" value="crear" id="accion">
    <input type="hidden" name="id_producto" id="id_producto">

    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" name="nombre" id="nombre" required>
    </div>

    <div class="form-group">
        <label for="descripcion">Descripción:</label>
        <input type="text" class="form-control" name="descripcion" id="descripcion" required>
    </div>

    <div class="form-group">
        <label for="precio">Precio:</label>
        <input type="number" class="form-control" name="precio" id="precio" required>
    </div>

    <div class="form-group">
        <label for="imagen">Imagen:</label>
        <input type="file" class="form-control" name="imagen" id="imagen" required>
    </div>

    <div class="form-group">
        <label for="categoria">Categoría:</label>
        <input type="text" class="form-control" name="categoria" id="categoria" required>
    </div>

    <div class="form-group">
        <label for="stock">Stock:</label>
        <input type="number" class="form-control" name="stock" id="stock" required>
    </div>

    <button type="submit" class="btn btn-success">Guardar Producto</button>
</form>

                <form action="../controlador/controlador_servicio.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="accion" value="agregar">

  

    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" name="nombre" required>
    </div>

    <div class="form-group">
        <label for="descripcion">Descripción:</label>
        <textarea class="form-control" name="descripcion" required></textarea>
    </div>

    <div class="form-group">
        <label for="precio">Precio:</label>
        <input type="number" step="0.01" class="form-control" name="precio" required>
    </div>

    <div class="form-group">
        <label for="imagen">Imagen URL:</label>
        <input type="file" class="form-control" name="imagen" required>
    </div>

  

    <div class="form-group">
        <label for="categoria">Categoría:</label>
        <input type="text" class="form-control" name="categoria" required>
    </div>

    <button type="submit" class="btn btn-primary">Agregar Servicio</button>
</form>
     
                
                
                
           
        
            
            
        </div>
        
        
    </main>

    <footer>
        <p>Correo:cosmetologiawmcj@gmail.com</p>
        <p>Telefono:3123211</p>

        
    </footer>

    
    
</body>
</html>