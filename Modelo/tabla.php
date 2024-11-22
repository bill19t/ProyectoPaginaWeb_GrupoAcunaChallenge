<?php
session_start();
include("../includes/conexion.php");

// Verificar si el usuario es admin
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../Inicio/login.php");
    exit();
}

$con = conectar();

$sql = "SELECT * FROM productos";
$query = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Gestión de Productos</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Gestión de Productos</h1>
        <div class="admin-header">
            <a href="insertar.php" class="btn-nuevo">Nuevo Producto</a>
            <a href="../Inicio/salir.php" class="btn-logout">Cerrar Sesión</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Modelo</th>
                    <th>Marca</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Imagen</th>
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
                                <img src="../Public/<?= $row['imagen'] ?>"
                                    alt="Imagen de <?= $row['modelo'] ?>"
                                    style="width: 100px; height: 100px; object-fit: cover;">
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