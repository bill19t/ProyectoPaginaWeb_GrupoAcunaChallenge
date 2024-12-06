<?php
session_start();
require_once(__DIR__ . "/../Modelo/conexion.php");
$con = conectar();

// Obtener el número de items en el carrito
$num_items_carrito = 0;
if (isset($_SESSION['usuario_id'])) {
    $usuario_id = $_SESSION['usuario_id'];
    $sql_carrito = "SELECT SUM(cantidad) as total FROM carrito WHERE usuario_id = ?";
    $stmt_carrito = mysqli_prepare($con, $sql_carrito);
    mysqli_stmt_bind_param($stmt_carrito, "i", $usuario_id);
    mysqli_stmt_execute($stmt_carrito);
    $result_carrito = mysqli_stmt_get_result($stmt_carrito);
    $row_carrito = mysqli_fetch_assoc($result_carrito);
    $num_items_carrito = $row_carrito['total'] ?? 0;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Rincón del Móvil Perú - <?php echo $titulo ?? ''; ?></title>
    <link rel="stylesheet" href="../Public/CSS/style.css">
</head>

<body>
    <header>
        <nav>
            <div style="display: flex; align-items: center;">
                <img src="../Public/llamita_god.png" alt="El Rincón del Móvil Perú" style="width: 100px; height: auto;">
            </div>
            <ul>
                <li><a href="../Vista/inicio.php">Inicio |</a></li>
                <li><a href="../Vista/productos.php">Productos |</a></li>
                <li><a href="../Vista/ubicacion.php">Ubicación |</a></li>
                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <li><a href="../Vista/carrito.php">
                            Carrito
                            <?php if ($num_items_carrito > 0): ?>
                                <span class="cart-count">(<?php echo $num_items_carrito; ?>)</span>
                            <?php endif; ?>
                        </a></li>
                    <li><a href="../Inicio/salir.php">Cerrar sesión</a></li>
                <?php else: ?>
                    <li><a href="../Inicio/login.php">Iniciar sesión</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>