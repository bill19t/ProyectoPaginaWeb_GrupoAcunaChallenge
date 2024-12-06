<?php include '../includes/header.php'; ?>
<?php

$telefono = [
    'nombre' => 'Smartphone Galaxy X10',
    'marca' => 'Samsung',
    'precio' => 999.99,
    'descripcion' => 'El Galaxy X10 cuenta con una pantalla AMOLED de 6.7 pulgadas, procesador de alto rendimiento y una cámara triple de 108 MP.',
    'caracteristicas' => [
        'Pantalla' => 'AMOLED 6.7 pulgadas',
        'Procesador' => 'Octa-Core 3.0 GHz',
        'Cámara Principal' => '108 MP + 12 MP + 5 MP',
        'Batería' => '5000 mAh con carga rápida',
        'Sistema Operativo' => 'Android 12',
        'Conectividad' => '5G, Wi-Fi 6, Bluetooth 5.2'
    ],
    'imagen' => ''
];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descripción del Teléfono</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .producto-imagen {
            text-align: center;
        }

        .producto-imagen img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .producto-info {
            margin-top: 20px;
        }

        .producto-info h1 {
            color: #333;
        }

        .producto-info p {
            color: #666;
            line-height: 1.6;
        }

        .caracteristicas {
            margin-top: 20px;
        }

        .caracteristicas ul {
            list-style: none;
            padding: 0;
        }

        .caracteristicas ul li {
            background: #f4f4f9;
            margin: 5px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .precio {
            color: #e63946;
            font-size: 1.5em;
            font-weight: bold;
            margin-top: 20px;
        }

        .boton-comprar {
            display: inline-block;
            margin-top: 20px;
            background: #0077cc;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1.2em;
        }

        .boton-comprar:hover {
            background: #005fa3;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="producto-imagen">
            <img src="<?php echo $telefono['imagen']; ?>" alt="Imagen del teléfono">
        </div>
        <div class="producto-info">
            <h1><?php echo $telefono['nombre']; ?></h1>
            <p><strong>Marca:</strong> <?php echo $telefono['marca']; ?></p>
            <p><?php echo $telefono['descripcion']; ?></p>
            <p class="precio">Precio: $<?php echo number_format($telefono['precio'], 2); ?></p>
        </div>
        <div class="caracteristicas">
            <h2>Características:</h2>
            <ul>
                <?php foreach ($telefono['caracteristicas'] as $key => $value): ?>
                    <li><strong><?php echo $key; ?>:</strong> <?php echo $value; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <a href="#" class="boton-comprar">Comprar ahora</a>
    </div>
</body>
<dic>
    </div>

</html>

<?php include '../includes/footer.php'; ?>