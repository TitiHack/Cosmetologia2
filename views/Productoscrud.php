<?php
session_start();
include_once '../controlador/controlador_producto.php'; // Asegúrate de incluir el controlador
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Playwrite+CU:wght@100..400&display=swap" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/styles-productos.css"> 
</head>
<body>
    <header style="background-color:black; font-family:'Merienda'; height:9rem;" class="text-white text-center py-3">
        <h1>Gestión de Productos</h1>
        <nav>
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link text-white" href="../views/index.php">Inicio</a>
                </li>
               
                <li class="nav-item">
                    <a class="nav-link text-white" href="../views/serviciosCrud.php">Servicios</a>
                </li>
            </ul>
        </nav>
    </header>

    <div class="container mt-5">
        <h2>Agregar/Actualizar Producto</h2>
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
                <label for="categoria">Categoria:</label>
                <input type="text" class="form-control" name="categoria" id="categoria" required>
            </div>
           
            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="number" class="form-control" name="stock" id="stock" required>
            </div>
            <button type="submit" class="btn btn-success">Guardar Producto</button>
        </form>

        <h2>Lista de Productos</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Producto</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th>Documento Proveedor</th>
                    <th>Categoria</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $todosProductos = $producto->obtenerTodos();
                foreach ($todosProductos as $producto) {
                    echo "<tr>
                        <td>{$producto['id_producto']}</td>
                        <td>{$producto['nombre']}</td>
                        <td>{$producto['descripcion']}</td>
                        <td>{$producto['precio']}</td>
                        <td><img src='{$producto['imagen']}' alt='Imagen' width='50'></td>
                        <td>{$producto['docu_prov']}</td>
                        <td>{$producto['categoria']}</td>
                        <td>{$producto['stock']}</td>
                        <td>
                                     <button class='btn btn-success' onclick='abrirModal({$producto['id_producto']}, \"{$producto['nombre']}\", \"{$producto['descripcion']}\", {$producto['precio']}, \"{$producto['imagen']}\", \"{$producto['docu_prov']}\", {$producto['stock']}, \"{$producto['categoria']}\")'>Editar</button>

                            <form action='../controlador/controlador_producto.php' method='post' style='display:inline;'>
                                <input type='hidden' name='accion' value='eliminar'>
                                <input type='hidden' name='id_producto' value='{$producto['id_producto']}'>
                                <button type='submit' class='btn btn-danger' onclick='return confirm(\"¿Estás seguro de eliminar este producto?\")'>Eliminar</button>
                            </form>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
<div class="modal fade" id="modalActualizar" tabindex="-1" aria-labelledby="modalActualizarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalActualizarLabel">Actualizar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formActualizar" action="../controlador/controlador_producto.php" method="post">
                    <input type="hidden" name="accion" value="actualizar">
                    <input type="hidden" name="id_producto" value="" id="id_producto2">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre2" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion2" name="descripcion" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" class="form-control" id="precio2" name="precio" step="0.01" required>
                    </div>
                   
                    <div class="mb-3">
                        <label for="docu_prov" class="form-label">Documento de Proveedor</label>
                        <input type="text" class="form-control" id="docu_prov2" name="docu_prov" required>
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="stock2" name="stock" required>
                    </div>
                    <div class="mb-3">
                        <label for="categoria" class="form-label">Categoría</label>
                        <input type="text" class="form-control" id="categoria2" name="categoria" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function abrirModal(id, nombre, descripcion, precio, imagen, docu_prov, stock, categoria) {
    document.getElementById('id_producto2').value = id;
    document.getElementById('nombre2').value = nombre;
    document.getElementById('descripcion2').value = descripcion;
    document.getElementById('precio2').value = precio;
    document.getElementById('docu_prov2').value = docu_prov;
    document.getElementById('stock2').value = stock;
    document.getElementById('categoria2').value = categoria;

    // Mostrar la modal
    var myModal = new bootstrap.Modal(document.getElementById('modalActualizar'), {
        keyboard: false
    });
    myModal.show();
}
</script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
