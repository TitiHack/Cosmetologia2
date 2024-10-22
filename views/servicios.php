<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios</title>
    <link rel="stylesheet" href="../public/css/styles-servicios.css">
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
                    <button><a href="../views/nuevo.php">Nuevo</a></button>
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
        <div class="contenedor">
        <div class="slide">
            
                <button>
                        
                        <p>Hidratacion y nutricion de la piel</p>
                </button>             
            
            
                <button>
                    
                    <p>Tratamientos corporales</p>
                </button>             
            
            
                <button>
                    
                    <p>Depilacion</p>
                </button>             
            
            
                <button>
                    
                    <p>Tratamientos para el cabello</p>
                </button>             
            
            
                <button>
                    
                    <p>Tratamientos para el acné</p>
                </button>             
            
            
                <button>
                    
                    <p>Spa de uñas</p>
                </button>             
            
            
                <button>
                    
                    <p>Bronceado</p>
                </button>             
            
            
                <button>
                    
                    <p>Masajes</p>
                </button>             
            
            
        </div>
        
       

            <div class="slide2">
                <h1>a</h1>
                <?php foreach ($todosServicios as $servicio): ?>
                <div class="tarjeta">
                    <div class="div-tarjet-img">
                        <img src="<?php echo $servicio['imagen']; ?>" alt="<?php echo $servicio['nombre']; ?>">
                    </div>
                    <h2 class="nameProduct"><?php echo $servicio['nombre']; ?></h2>
                    
                    <div class="category">
                        <p class="SpaceP">Categoria:   </p>
                    <p><?php echo $servicio['categoria']; ?></p>

                    </div>
                    <div class="price">
                        <p  class="SpaceP">Precio:  </p>

                        <p class="precio"><?php echo number_format($servicio['precio'], 0, ',', '.'); ?>$</p>
                        
                    </div>
                    <button >Ver Mas...</button>
                </div>
                <?php endforeach; ?>
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