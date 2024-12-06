<?php
$titulo = "Procesar Pago";
include '../Includes/header.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../Inicio/login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// Obtener los productos en el carrito
$sql_carrito = "SELECT c.*, p.modelo, p.precio, c.cantidad FROM carrito c 
                JOIN productos p ON c.producto_id = p.id 
                WHERE c.usuario_id = ?";
$stmt_carrito = mysqli_prepare($con, $sql_carrito);
mysqli_stmt_bind_param($stmt_carrito, "i", $usuario_id);
mysqli_stmt_execute($stmt_carrito);
$result_carrito = mysqli_stmt_get_result($stmt_carrito);

$total = 0;
while ($row = mysqli_fetch_assoc($result_carrito)) {
    $subtotal = $row['precio'] * $row['cantidad'];
    $total += $subtotal;
}

// Confirmar pago (puedes agregar lógica aquí para registrar el pago en tu base de datos)
if (isset($_POST['confirmar_pago'])) {
    // Aquí podrías guardar el registro del pago en la base de datos o enviar una confirmación al cliente.
    echo "<script>alert('Pago confirmado. Gracias por tu compra.');</script>";
    header("Location: ../Inicio/index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
        }

        .qr-container img {
            width: 250px;
            height: 250px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <h1>Procesar Pago</h1>
    <p>Total a pagar: <strong>S/ <?php echo number_format($total, 2); ?></strong></p>
    <p>Escanea el código QR con Yape para realizar el pago:</p>

    <div class="qr-container">
        <img src="../Public/QRChavo.jpeg" alt="Código QR de Yape">
    </div>

    <form method="POST" action="">
        <button type="submit" name="confirmar_pago" class="btn">Confirmar Pago</button>
    </form>

    <a href="carrito.php" class="btn">Volver al Carrito</a>
</body>

</html>

<?php include '../Includes/footer.php'; ?>