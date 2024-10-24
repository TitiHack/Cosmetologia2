

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Servicios</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <header>
        <h1 class="text-center">Gestión de Servicios</h1>
    </header>

    <section class="mt-4">
        <h2>Agregar Nuevo Servicio</h2>
        <form action="../controlador/controlador_servicio.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="accion" value="agregar">
          
            <div class="form-group">
                <label for="id_servicio">Id:</label>
                <input type="text" name="id_servicio" class="form-control" required>
            </div>
            <div class="form-group">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" step="0.01" name="precio" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="imagen">Imagen URL:</label>
                <input type="file" name="imagen" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="docu_prov">Documento Proveedor:</label>
                <input type="text" name="docu_prov" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="categoria">Categoría:</label>
                <input type="text" name="categoria" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Servicio</button>
        </form>
    </section>

    <section class="mt-4">
        <h2>Lista de Servicios</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Servicio</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th>Documento Proveedor</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($todosServicios as $servicio): ?>
                <tr>
                    <td><?php echo $servicio['id_servicio']; ?></td>
                    <td><?php echo $servicio['nombre']; ?></td>
                    <td><?php echo $servicio['descripcion']; ?></td>
                    <td><?php echo $servicio['precio']; ?></td>
                    <td><img src="<?php echo $servicio['imagen']; ?>" alt="Imagen" width="100"></td>
                    <td><?php echo $servicio['docu_prov']; ?></td>
                    <td><?php echo $servicio['categoria']; ?></td>
                    <td>
                        <form action="" method="POST" style="display:inline;">
                            <input type="hidden" name="accion" value="eliminar">
                            <input type="hidden" name="id_servicio" value="<?php echo $servicio['id_servicio']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                        <button class="btn btn-warning btn-sm" onclick="editarServicio(<?php echo htmlspecialchars(json_encode($servicio)); ?>)">Modificar</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</div>

<!-- Modal para editar servicio -->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarLabel">Modificar Servicio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditar" action="" method="POST">
                    <input type="hidden" name="accion" value="modificar">
                    <input type="hidden" name="id_servicio" id="editIdServicio">
                    <div class="form-group">
                        <label for="editNombre">Nombre:</label>
                        <input type="text" name="nombre" id="editNombre" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="editDescripcion">Descripción:</label>
                        <textarea name="descripcion" id="editDescripcion" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editPrecio">Precio:</label>
                        <input type="number" step="0.01" name="precio" id="editPrecio" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="editImagen">Imagen URL:</label>
                        <input type="text" name="imagen" id="editImagen" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="editDocuProv">Documento Proveedor:</label>
                        <input type="text" name="docu_prov" id="editDocuProv" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="editCategoria">Categoría:</label>
                        <input type="text" name="categoria" id="editCategoria" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Modificar Servicio</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
function editarServicio(servicio) {
    document.getElementById('editIdServicio').value = servicio.id_servicio;
    document.getElementById('editNombre').value = servicio.nombre;
    document.getElementById('editDescripcion').value = servicio.descripcion;
    document.getElementById('editPrecio').value = servicio.precio;
    document.getElementById('editImagen').value = servicio.imagen;
    document.getElementById('editDocuProv').value = servicio.docu_prov;
    document.getElementById('editCategoria').value = servicio.categoria;
    
    $('#modalEditar').modal('show');
}

function cerrarModal() {
    document.getElementById('modalEditar').style.display = 'none';
}
</script>



</body>
</html>