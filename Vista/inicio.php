<?php
$titulo = "Inicio";
include '../includes/header.php';
include '../includes/verificar_sesion.php';
check_session();
?>

<div class="container">
    <h1>Bienvenido a El Rincón del Móvil Perú</h1>
    

    <section class="Productos">
        <h2>Productos más vendidos</h2>
        <div class="product-grid">
            <?php
            $featuredProducts = [
                [
                    'name' => 'Xiaomi Redmi Note 10',
                    'price' => 'S/ 799',
                    'image' => '../public/img/productos/Xiaomi.png' // Reemplazado con ruta correcta
                ],
                [
                    'name' => 'Samsung Galaxy A52',
                    'price' => 'S/ 1299',
                    'image' => '../public/img/productos/Galaxy.png' // Reemplazado con ruta correcta
                ],
                [
                    'name' => 'iPhone 12',
                    'price' => 'S/ 3499',
                    'image' => '../public/img/productos/Iphone12.png' // Ruta correcta de imagen
                ],
            ];

            foreach ($featuredProducts as $product) {
                echo "<div class='product-card'>";
                echo "<img src='{$product['image']}' alt='{$product['name']}' class='product-image'>";
                echo "<h3>{$product['name']}</h3>";
                echo "<p>{$product['price']}</p>";
                echo "<a href='#' class='btn btn-small'>Ver Detalles</a>";
                echo "</div>";
            }
            ?>
        </div>
    </section>
    <section class="clientes">
        <h2>Clientes</h2>
        <div class="clientes-gallery">
            <img src="../public/img/cliente1.jpg" alt="Cliente 1" width="300 px" height="460 px"  class="clientes-image">
            <img src="../public/img/cliente2.jpg" alt="Cliente 2" width="300 px" height="460 px" class="clientes-image">
            <img src="../public/img/cliente3.jpg" alt="Cliente 3" width="300 px" height="460 px" class="clientes-image">
        </div>
    </section>
</div>

<?php include '../includes/footer.php'; ?>