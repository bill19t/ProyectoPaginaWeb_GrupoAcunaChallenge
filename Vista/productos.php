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
            // La ruta de la imagen ya está guardada relativamente
            //echo "<img src='/Public/IMG/productos/{$row['imagen']}' alt='{$row['modelo']}'>";
            echo "<img src='../Public/IMG/productos/{$row['imagen']}' alt='Imagen de {$row['modelo']}' width='100' height='100'>";
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