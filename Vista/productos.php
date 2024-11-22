<?php include '../includes/header.php'; ?>

<div class="container">
    <h1>Nuestros Productos</h1>
    <div class="product-grid">
        <?php
        include("../includes/conexion.php");
        $con = conectar();

        $sql = "SELECT * FROM productos ORDER BY fecha_creacion DESC";
        $query = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_array($query)) {
            echo "<div class='product-card'>";
            // Corregimos la ruta de la imagen
            if (!empty($row['imagen'])) {
                echo "<img src='../Public/{$row['imagen']}' alt='Imagen de {$row['modelo']}' style='width: 100%; height: 200px; object-fit: cover;'>";
            } else {
                echo "<img src='../Public/IMG/productos/default.jpg' alt='Imagen no disponible' style='width: 100%; height: 200px; object-fit: cover;'>";
            }
            echo "<h3>{$row['modelo']}</h3>";
            echo "<p class='marca'>{$row['marca']}</p>";
            echo "<p class='precio'>S/ {$row['precio']}</p>";
            echo "<p class='stock'>Stock: {$row['stock']} unidades</p>";
            echo "<a href='#' class='btn btn-small'>Ver Detalles</a>";
            echo "</div>";
        }
        ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>