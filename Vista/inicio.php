<?php
$titulo = "Inicio";
include '../Includes/header.php';
include '../Controlador/verificar_sesion.php';
check_session();
?>

<div class="container">
    <h1>Bienvenido a El Rincón del Móvil Perú</h1>
    <section class="Productos">
        <div style="text-align: center; margin: 20px 0;">
            <img src="../Public/Banner.gif" alt="GIF dinámico" style="max-width: 100%; height: auto; border-radius: 10px;">
        </div>
        <h2>Nuestros Productos Destacados</h2>
        <div class="product-grid">
            <?php
            $featuredProducts = [
                [
                    'id' => 1,
                    'name' => 'Xiaomi Redmi Note 10',
                    'price' => 'S/ 799',
                    'image' => '../Public/IMG/XiaomiNote10.png'
                ],
                [
                    'id' => 2,
                    'name' => 'Samsung Galaxy A52',
                    'price' => 'S/ 1299',
                    'image' => '../Public/IMG/A52.jpeg'
                ],
                [
                    'id' => 3,
                    'name' => 'iPhone 12',
                    'price' => 'S/ 3499',
                    'image' => '../Public/IMG/iphone12.jpeg'
                ],
            ];

            foreach ($featuredProducts as $product) {
                echo "<div class='product-card'>";
                echo "<img src='{$product['image']}' alt='{$product['name']}' class='product-image'>";
                echo "<h3>{$product['name']}</h3>";
                echo "<p>{$product['price']}</p>";
                echo "<a href='detalles_vendidos.php?id={$product['id']}' class='btn btn-small'>Ver Detalles</a>";
                echo "</div>";
            }
            ?>
        </div>
    </section>
    <section class="clientes">
        <h2>Nuestros Clientes Satisfechos</h2>
        <div class="clientes-gallery">
            <img src="../Public/IMG/cliente1.jpg" alt="Cliente 1" width="300" height="460" class="clientes-image">
            <img src="../Public/IMG/cliente2.jpg" alt="Cliente 2" width="300" height="460" class="clientes-image">
            <img src="../Public/IMG/cliente3.jpg" alt="Cliente 3" width="300" height="460" class="clientes-image">
        </div>
    </section>
</div>

<?php include '../Includes/footer.php'; ?>