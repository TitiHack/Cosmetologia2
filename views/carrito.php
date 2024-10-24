<?php
session_start();

$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras - Cosmetología</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/styles.css">
    <style>
        body {
            background-color: #f9f7f7;
            font-family: 'Arial', sans-serif;
        }
        header {
            background-color: #f1c3d6;
            padding: 20px;
            height: rem;
            text-align: center;
        }
        header h1 {
            color: #6a1b9a;
            font-family: 'Cursive', sans-serif;
        }
        .table {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .total {
            font-size: 1.5em;
            font-weight: bold;
            color: #6a1b9a;
        }
        footer {
            background-color: #f1c3d6;
            text-align: center;
            padding: 10px;
            position: relative;
            bottom: 0;
            width: 100%;
        }
        .btn-custom {
            background-color: #6a1b9a;
            color: white;
        }
        .btn-custom:hover {
            background-color: #4a148c;
        }
    </style>
</head>
<body>
    <header>
        <h1>Carrito de Compras</h1>
    </header>
    <main class="container mt-4">
        <?php if (empty($carrito)): ?>
            <div class="alert alert-warning" role="alert">
                Tu carrito está vacío.
            </div>
        <?php else: ?>
            <!-- Formulario para actualizar el carrito -->
            <form action="../controlador/controlador_actualizar_carrito.php" method="post">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($carrito as $index => $item): ?>
                                <tr>
                                    <td><img src="<?php echo $item['imagen']; ?>" alt="<?php echo $item['nombre']; ?>" style="width: 100px;"></td>
                                    <td><?php echo htmlspecialchars($item['nombre']); ?></td>
                                    <td><?php echo number_format($item['precio'], 0, ',', '.'); ?>$</td>
                                    <td>
                                        <input type="number" name="productos[<?php echo $index; ?>][cantidad]" value="<?php echo $item['cantidad']; ?>" min="1" max="<?php echo $item['stock']; ?>">
                                        <input type="hidden" name="productos[<?php echo $index; ?>][id]" value="<?php echo $item['id']; ?>">
                                    </td>
                                    <td>
                                        <a href="../controlador/controlador_eliminar_producto.php?id=<?php echo $item['id']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    <h4 class="total">Total: 
                        <?php 
                        $total = 0;
                        foreach ($carrito as $item) {
                            $total += $item['precio'] * $item['cantidad'];
                        }
                        echo number_format($total, 0, ',', '.'); 
                        ?>$
                    </h4>
                </div>
                <div class="text-right mt-4">
                    <button class="btn btn-custom" type="submit">Actualizar Carrito</button>
                </div>
            </form>

            <!-- Formulario separado para proceder a la compra -->
            <form action="../controlador/controlador_compras.php" method="post">
                <?php foreach ($carrito as $index => $item): ?>
                    <input type="hidden" name="productos[<?php echo $index; ?>][id]" value="<?php echo $item['id']; ?>">
                    <input type="hidden" name="productos[<?php echo $index; ?>][cantidad]" value="<?php echo $item['cantidad']; ?>">
                <?php endforeach; ?>
                <div class="text-right mt-2">
                    <button type="submit" class="btn btn-success">Proceder a la compra</button>
                </div>
            </form>

        <?php endif; ?>
    </main>

    <footer>
        <p>© 2024 Cosmetología Ilusión Y Belleza</p>
    </footer>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
