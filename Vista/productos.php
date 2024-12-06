<?php
require_once('../Includes/header.php');
$con = conectar();

// Manejar la adición al carrito
if (isset($_POST['agregar_carrito'])) {
    if (!isset($_SESSION['usuario_id'])) {
        // Si el usuario no ha iniciado sesión, redirigir a la página de login
        header("Location: ../Inicio/login.php?redirect=productos");
        exit();
    }

    $producto_id = $_POST['producto_id'];
    $usuario_id = $_SESSION['usuario_id'];

    // Verificar si el producto ya está en el carrito
    $sql_check = "SELECT * FROM carrito WHERE usuario_id = ? AND producto_id = ?";
    $stmt_check = mysqli_prepare($con, $sql_check);
    mysqli_stmt_bind_param($stmt_check, "ii", $usuario_id, $producto_id);
    mysqli_stmt_execute($stmt_check);
    $result_check = mysqli_stmt_get_result($stmt_check);

    if (mysqli_num_rows($result_check) > 0) {
        // Si ya existe, actualizar la cantidad
        $sql_update = "UPDATE carrito SET cantidad = cantidad + 1 WHERE usuario_id = ? AND producto_id = ?";
        $stmt_update = mysqli_prepare($con, $sql_update);
        mysqli_stmt_bind_param($stmt_update, "ii", $usuario_id, $producto_id);
        mysqli_stmt_execute($stmt_update);
    } else {
        // Si no existe, insertar nuevo registro
        $sql_insert = "INSERT INTO carrito (usuario_id, producto_id) VALUES (?, ?)";
        $stmt_insert = mysqli_prepare($con, $sql_insert);
        mysqli_stmt_bind_param($stmt_insert, "ii", $usuario_id, $producto_id);
        mysqli_stmt_execute($stmt_insert);
    }

    header("Location: productos.php?mensaje=agregado");
    exit();
}

// Manejar la búsqueda
$search = '';
if (isset($_GET['buscar'])) {
    $search = trim($_GET['buscar']);
}
?>

<div class="container">
    <h1>Nuestros Productos</h1>

    <!-- Barra de búsqueda -->
    <form method="GET" action="productos.php" class="form-busqueda">
        <input
            type="text"
            name="buscar"
            placeholder="Buscar productos..."
            value="<?php echo htmlspecialchars($search); ?>"
            class="input-busqueda">
        <button type="submit" class="btn-busqueda">Buscar</button>
    </form>

    <?php if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'agregado'): ?>
        <div class="mensaje-exito">Producto agregado al carrito exitosamente</div>
    <?php endif; ?>

    <div class="product-grid">
        <?php
        // Consulta con filtro de búsqueda
        $sql = "SELECT * FROM productos WHERE modelo LIKE ? OR marca LIKE ? ORDER BY fecha_creacion DESC";
        $stmt = mysqli_prepare($con, $sql);
        $like_search = "%$search%";
        mysqli_stmt_bind_param($stmt, "ss", $like_search, $like_search);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                echo "<div class='product-card'>";
                if (!empty($row['imagen'])) {
                    echo "<img src='../Public/{$row['imagen']}' alt='Imagen de {$row['modelo']}' style='width: 100%; height: 200px; object-fit: cover;'>";
                } else {
                    echo "<img src='../Public/IMG/productos/default.jpg' alt='Imagen no disponible' style='width: 100%; height: 200px; object-fit: cover;'>";
                }
                echo "<h3>{$row['modelo']}</h3>";
                echo "<p class='marca'>{$row['marca']}</p>";
                echo "<p class='precio'>S/ {$row['precio']}</p>";
                echo "<p class='stock'>Stock: {$row['stock']} unidades</p>";
                echo "<a href='../Vista/detalle_producto.php?id={$row['id']}' class='btn btn-small'>Ver Detalles</a>";
                echo "<form method='POST' action='productos.php'>";
                echo "<input type='hidden' name='producto_id' value='{$row['id']}'>";
                echo "<button type='submit' name='agregar_carrito' class='btn-carrito'>Agregar al Carrito</button>";
                echo "</form>";
                echo "</div>";
            }
        } else {
            echo "<p>No se encontraron productos que coincidan con la búsqueda.</p>";
        }
        ?>
    </div>
</div>

<?php include '../Includes/footer.php'; ?>