<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo</title>
    <link rel="stylesheet" href="../public/css/styles-nuevo.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
            <p><a href="../views/index.php">Inicio</a></p>
            <p><a href="../views/servicios.php">Servicios</a></p>
            <p><a href="../views/productos.php">Productos</a></p>
            <p><a href="../views/acercade.php">Acerca de</a></p>
        </div>

        <div class="slide">
            

            <div class="contenido">           
                <div>        
                <form method="POST">
                        <h2>Producto</h2>
                        <p>Nombre</p>
                        <input type="text" name="nombre">
                        <p>Descripcion</p>
                        <input type="text" name="descripcion">
                        <p>Precio</p>
                        <input type="number" name="precio" id="">
                        <p>Categoria</p>
                        <input type="text"`name="categoria">
                        <p>Insertar imagen</p>
                        <input type="file" name="imagen">
                        <input value="Agregar producto" type="submit" name="agregar"></input>
                    </form>
                </div>
                <div>
                    <form action="">
                    <h2>Servicio</h2>
                        <p>Nombre</p>
                        <input type="text">
                        <p>Descripcion</p>
                        <input type="text">
                        <p>Precio</p>
                        <input type="number" name="" id="">
                        <p>Categoria</p>
                        <input type="text">
                        <p>Insertar imagen</p>
                        <input type="file">
                        <input value="Agregar servicio" type="submit" name="agregar"></input>
                    </form>
                </div>
                
                
                
                
            </div>
        
            
            
        </div>
        
        
    </main>

    <footer>
        <p>Correo:cosmetologiawmcj@gmail.com</p>
        <p>Telefono:3123211</p>

        <div>
            <img src="../public/images/bxl-whatsapp.svg" alt="">
            <img src="../public/images/bxl-instagram.svg" alt="">
        </div>

    </footer>

    
    
</body>
</html>