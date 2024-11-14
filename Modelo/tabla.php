<?php
include("conexion.php");
$con = conectar();

$sql = "SELECT * FROM productos";
$query = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Productos</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Gestión de Productos</h1>
        <a href="insertar.php" class="btn-nuevo">Nuevo Producto</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Modelo</th>
                    <th>Marca</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Imagen</th> <!-- Nueva columna para la imagen -->
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_array($query)): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['modelo'] ?></td>
                        <td><?= $row['marca'] ?></td>
                        <td><?= $row['precio'] ?></td>
                        <td><?= $row['stock'] ?></td>
                        <td>
                            <?php if (!empty($row['imagen'])): ?>
                                <img src="../Public/IMG/productos/<?= $row['imagen'] ?>" alt="Imagen de <?= $row['modelo'] ?>" width="100" height="100">
                            <?php else: ?>
                                No disponible
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="actualizar.php?id=<?= $row['id'] ?>" class="btn-editar">Editar</a>
                            <a href="eliminar.php?id=<?= $row['id'] ?>" class="btn-eliminar">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

</html>