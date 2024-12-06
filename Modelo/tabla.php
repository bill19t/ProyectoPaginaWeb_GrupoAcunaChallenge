<?php
session_start();
include("../Modelo/conexion.php");

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
            <a href="../Controlador/insertar.php" class="btn-nuevo">Nuevo Producto</a>
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
                    <th>Pantalla</th>
                    <th>Procesador</th>
                    <th>Cámara</th>
                    <th>Batería</th>
                    <th>SO</th>
                    <th>Conectividad</th>
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
                                <img src="../Public/<?= $row['imagen'] ?>" alt="Imagen de <?= $row['modelo'] ?>" style="width: 100px; height: 100px; object-fit: cover;">
                            <?php else: ?>
                                No disponible
                            <?php endif; ?>
                        </td>
                        <td><?= $row['Pantalla'] ?></td>
                        <td><?= $row['Procesador'] ?></td>
                        <td><?= $row['Camara_Principal'] ?></td>
                        <td><?= $row['Bateria'] ?></td>
                        <td><?= $row['Sistema_Operativo'] ?></td>
                        <td><?= $row['Conectividad'] ?></td>
                        <td>
                            <a href="../Controlador/actualizar.php?id=<?= $row['id'] ?>" class="btn-editar">Editar</a>
                            <a href="../Controlador/eliminar.php?id=<?= $row['id'] ?>" class="btn-eliminar">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

</html>