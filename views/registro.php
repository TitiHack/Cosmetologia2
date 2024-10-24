<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="../public/css/styles-registro.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Playwrite+CU:wght@100..400&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <h2>Registrarse</h2>
        <nav>
            <li><a href="../views/index.php">Inicio</a></li>
            <li><a href="../views/inicio-sesion.php">Iniciar sesión</a></li>
            <li><a href="../views/acercade.php">Acerca de</a></li>
        </nav>
    </header>

    <div class="container">
        <div class="mitad1">
            <img src="../public/images/logo2.jpeg" alt="">
        </div>


    <script src="../js/app.js"></script>
    <form id="clienteForm" action="../controlador/controlador_cliente.php" method="post" onsubmit="return cambiarAccion();">
    <input type="hidden" name="accion" value="crearcliente"> 
    <div class="contenido">
        <div class="contItems">
            <div class="alineado">
                <h3>Correo:</h3>
                <input type="email" name="email" required>
            </div>
            <div class="alineado">
                <h3 id="docuLabel">Documento:</h3>
                <input type="text" id="docuInput" name="docu_clie" required>
            </div>
            <div class="alineado">
                <h3>Celular:</h3>
                <input type="text" name="celular" required>
            </div>

            <div class="alineado">
                <h3>Nombre:</h3>
                <input type="text" name="nombre" required>
            </div>
            <div class="alineado">
                <h3>Apellido:</h3>
                <input type="text" name="apellido" required>
            </div>
            <div class="alineado">
                <h3>Contraseña:</h3>
                <input type="password" name="contraseña" required>
            </div>
        </div>

        <div class="chulito">
            <h4>Crear cuenta como proveedor</h4>
            <input type="checkbox" name="check" id="chulito">
        </div>

        <input name="registrarB" type="submit" value="Registrarse">
    </div>
</form>


<script>
    function cambiarAccion() {
        var checkBox = document.getElementById('chulito');
        var form = document.getElementById('clienteForm');

        if (checkBox.checked) {
            // Cambia la acción del formulario al controlador del proveedor
            form.action = "../controlador/controlador_proveedor.php";
            // Cambia el valor de la acción
            form.querySelector('input[name="accion"]').value = 'crear';
            cambiarNombreCampo();
        } else {
            // Cambia la acción del formulario al controlador del cliente
            form.action = "../controlador/controlador_cliente.php";
            // Cambia el valor de la acción
            form.querySelector('input[name="accion"]').value = 'crear';
        }

        return true; // Permite que el formulario se envíe
    }

    function cambiarNombreCampo() {
        var checkBox = document.getElementById('chulito');
        var docuLabel = document.getElementById('docuLabel');
        var docuInput = document.getElementById('docuInput');

        if (checkBox.checked) {
            // Cambia el nombre del campo a 'docu_prov'
            docuLabel.textContent = "Documento Proveedor:";
            docuInput.name = "docu_prov";
        } else {
            // Cambia el nombre del campo a 'docu_clie'
            docuLabel.textContent = "Documento:";
            docuInput.name = "docu_clie";
        }
    }
</script>

</body>

</html>
