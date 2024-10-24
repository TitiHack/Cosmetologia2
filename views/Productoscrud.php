<?php
session_start();
include_once '../controlador/controlador_producto.php'; // Asegúrate de incluir el controlador
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/styles-productos.css"> 
</head>
<body>
    <header class="bg-primary text-white text-center py-3">
        <h1>Gestión de Productos</h1>
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
                <label for="docu_prov">Documento Proveedor:</label>
                <input type="text" class="form-control" name="docu_prov" id="docu_prov" required>
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
                         <form action='../controlador/controlador_producto.php' method='post' style='display:inline;'>
                                <input type='hidden' name='accion' value='actualizar'>
                                <input type='hidden' name='id_producto' value='{$producto['id_producto']}'>
                                <button type='submit' class='btn btn-success' '>Editar</button>
                            </form>
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

    <script>
        function editarProducto(producto) {
            document.getElementById('accion').value = 'actualizar';
            document.getElementById('id_producto').value = producto.id_producto;
            document.getElementById('nombre').value = producto.nombre;
            document.getElementById('descripcion').value = producto.descripcion;
            document.getElementById('precio').value = producto.precio;
            document.getElementById('imagen').value = producto.imagen;
            document.getElementById('docu_prov').value = producto.docu_prov;
            document.getElementById('stock').value = producto.stock;
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
