<?php
session_start();
include_once '../controlador/controlador_cliente.php'; // Asegúrate de incluir el controlador
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clientes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header class="bg-success text-white text-center py-3">
        <h1>Gestión de clientes</h1>
        <nav>
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link text-white" href="../views/index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../views/inicio-sesion.php">Iniciar sesión</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../views/acercade.php">Acerca de</a>
                </li>
            </ul>
        </nav>
    </header>

    <div class="m-5 mt-5">
        <h2>Agregar Clientes</h2>
        <form action="../controlador/controlador_cliente.php" method="POST" class="mb-4">
            <input type="hidden" name="accion" value="crear" id="accion">
            <div class="form-group">
                <label for="docu_clie">Documento:</label>
                <input type="text" class="form-control" name="docu_clie" id="docu_clie" required>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" class="form-control" name="apellido" id="apellido" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="celular">Celular:</label>
                <input type="text" class="form-control" name="celular" id="celular" required>
            </div>
            <div class="form-group">
                <label for="contraseña">Contraseña:</label>
                <input type="password" class="form-control" name="contraseña" id="contraseña" required>
            </div>
            <button type="submit" class="btn btn-success">Guardar Cliente</button>    
        </form>

        <h2>Lista de Clientes</h2>
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>Documento</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Celular</th>
                    <th>Contraseña</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $todosClientes = $cliente->obtenerTodos();
                foreach ($todosClientes as $cliente) {
                    echo "<tr>
                        <td>{$cliente['docu_clie']}</td>
                        <td>{$cliente['nombre']}</td>
                        <td>{$cliente['apellido']}</td>
                        <td>{$cliente['email']}</td>
                        <td>{$cliente['celular']}</td>
                        <td>{$cliente['contraseña']}</td>
                        <td>
                            <button class='btn btn-warning' data-toggle='modal' data-target='#modalEditar' onclick='editarcliente(" . json_encode($cliente) . ")'>Editar</button>
                            <form action='' method='POST' style='display:inline;'>
                                <input type='hidden' name='accion' value='eliminar'>
                                <input type='hidden' name='docu_clie' value='{$cliente['docu_clie']}'>
                                <button type='submit' class='btn btn-danger' onclick='return confirm(\"¿Estás seguro de eliminar este cliente?\")'>Eliminar</button>
                            </form>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal para editar cliente -->
    <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalEditarLabel">Editar Cliente</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="../controlador/controlador_cliente.php" method="POST">
                <input type="hidden" name="accion" value="actualizar" id="accionModal">
                <div class="form-group">
                    <label for="docu_clie_modal">Documento:</label>
                    <input type="text" class="form-control" name="docu_clie" id="docu_clie_modal" required readonly>
                </div>
                <div class="form-group">
                    <label for="nombre_modal">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" id="nombre_modal" required>
                </div>
                <div class="form-group">
                    <label for="apellido_modal">Apellido:</label>
                    <input type="text" class="form-control" name="apellido" id="apellido_modal" required>
                </div>
                <div class="form-group">
                    <label for="email_modal">Email:</label>
                    <input type="email" class="form-control" name="email" id="email_modal" required>
                </div>
                <div class="form-group">
                    <label for="celular_modal">Celular:</label>
                    <input type="text" class="form-control" name="celular" id="celular_modal" required>
                </div>
                <div class="form-group">
                    <label for="contraseña_modal">Contraseña:</label>
                    <input type="password" class="form-control" name="contraseña" id="contraseña_modal" required>
                </div>
                <button type="submit" class="btn btn-success">Actualizar Cliente</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script>
        function editarcliente(cliente) {
            // Llenar el formulario del modal con los datos del cliente
            document.getElementById('docu_clie_modal').value = cliente.docu_clie;
            document.getElementById('nombre_modal').value = cliente.nombre;
            document.getElementById('apellido_modal').value = cliente.apellido;
            document.getElementById('email_modal').value = cliente.email;
            document.getElementById('celular_modal').value = cliente.celular;
            document.getElementById('contraseña_modal').value = cliente.contraseña;
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
