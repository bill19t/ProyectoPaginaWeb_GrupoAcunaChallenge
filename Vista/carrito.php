<?php
$titulo = "Carrito de Compras";
include '../Includes/header.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../Inicio/login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// Actualizar cantidades
if (isset($_POST['actualizar'])) {
    foreach ($_POST['cantidad'] as $producto_id => $cantidad) {
        if ($cantidad > 0) {
            $sql_update = "UPDATE carrito SET cantidad = ? WHERE usuario_id = ? AND producto_id = ?";
            $stmt_update = mysqli_prepare($con, $sql_update);
            mysqli_stmt_bind_param($stmt_update, "iii", $cantidad, $usuario_id, $producto_id);
            mysqli_stmt_execute($stmt_update);
        } else {
            $sql_delete = "DELETE FROM carrito WHERE usuario_id = ? AND producto_id = ?";
            $stmt_delete = mysqli_prepare($con, $sql_delete);
            mysqli_stmt_bind_param($stmt_delete, "ii", $usuario_id, $producto_id);
            mysqli_stmt_execute($stmt_delete);
        }
    }
}

// Eliminar producto
if (isset($_POST['eliminar'])) {
    $producto_id = $_POST['eliminar'];
    $sql_delete = "DELETE FROM carrito WHERE usuario_id = ? AND producto_id = ?";
    $stmt_delete = mysqli_prepare($con, $sql_delete);
    mysqli_stmt_bind_param($stmt_delete, "ii", $usuario_id, $producto_id);
    mysqli_stmt_execute($stmt_delete);
}

// Obtener los productos en el carrito
$sql_carrito = "SELECT c.*, p.modelo, p.marca, p.precio, p.imagen FROM carrito c 
                JOIN productos p ON c.producto_id = p.id 
                WHERE c.usuario_id = ?";
$stmt_carrito = mysqli_prepare($con, $sql_carrito);
mysqli_stmt_bind_param($stmt_carrito, "i", $usuario_id);
mysqli_stmt_execute($stmt_carrito);
$result_carrito = mysqli_stmt_get_result($stmt_carrito);

$total = 0;
?>

<div class="container">
    <h1>Carrito de Compras</h1>

    <?php if (mysqli_num_rows($result_carrito) == 0): ?>
        <p>Tu carrito está vacío</p>
        <a href="productos.php" class="btn">Ver Productos</a>
    <?php else: ?>
        <form method="POST" action="">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result_carrito)):
                        $subtotal = $row['precio'] * $row['cantidad'];
                        $total += $subtotal;
                    ?>
                        <tr>
                            <td>
                                <img src="../Public/<?php echo $row['imagen']; ?>" alt="<?php echo $row['modelo']; ?>" style="width: 50px; height: 50px; object-fit: cover;">
                                <?php echo $row['modelo']; ?>
                            </td>
                            <td>S/ <?php echo $row['precio']; ?></td>
                            <td>
                                <input type="number" name="cantidad[<?php echo $row['producto_id']; ?>]" value="<?php echo $row['cantidad']; ?>" min="0" max="99">
                            </td>
                            <td>S/ <?php echo number_format($subtotal, 2); ?></td>
                            <td>
                                <button type="submit" name="eliminar" value="<?php echo $row['producto_id']; ?>" class="btn-eliminar">Eliminar</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"><strong>Total</strong></td>
                        <td colspan="2"><strong>S/ <?php echo number_format($total, 2); ?></strong></td>
                    </tr>
                </tfoot>
            </table>

            <div class="cart-actions">
                <button type="submit" name="actualizar" class="btn">Actualizar Carrito</button>
                <a href="procesarpago.php" class="btn btn-primary">Proceder al Pago</a>
            </div>
        </form>
    <?php endif; ?>
</div>

<?php include '../Includes/footer.php'; ?>