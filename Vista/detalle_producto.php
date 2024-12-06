<?php
include("../Modelo/conexion.php");
$con = conectar();

$id = $_GET['id'];

$sql = "SELECT * FROM productos WHERE id = $id";
$query = mysqli_query($con, $sql);
$producto = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $producto['modelo']; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container h1 {
            margin: 0 0 20px;
            font-size: 28px;
            color: #007bff;
            text-align: center;
        }

        .container img {
            width: 80%;
            max-width: 800px;
            border-radius: 8px;
            border: 1px solid #ddd;
            object-fit: cover;
            margin-bottom: 20px;
        }

        .specs {
            width: 100%;
            max-width: 600px;
            margin-top: 20px;
        }

        .specs h2 {
            font-size: 20px;
            color: #007bff;
            margin-bottom: 10px;
        }

        .specs table {
            width: 100%;
            border-collapse: collapse;
        }

        .specs td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .specs td:first-child {
            font-weight: bold;
            width: 40%;
        }

        .container a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .container a:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .container img {
                width: 100%;
            }

            .specs {
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1><?php echo $producto['modelo']; ?></h1>
        <img src="../Public/<?php echo $producto['imagen']; ?>" alt="Imagen del producto">
        <div class="specs">
            <h2>Especificaciones</h2>
            <table>
                <tr>
                    <td>Marca:</td>
                    <td><?php echo $producto['marca']; ?></td>
                </tr>
                <tr>
                    <td>Pantalla:</td>
                    <td><?php echo $producto['Pantalla']; ?></td>
                </tr>
                <tr>
                    <td>Procesador:</td>
                    <td><?php echo $producto['Procesador']; ?></td>
                </tr>
                <tr>
                    <td>Cámara Principal:</td>
                    <td><?php echo $producto['Camara_Principal']; ?></td>
                </tr>
                <tr>
                    <td>Batería:</td>
                    <td><?php echo $producto['Bateria']; ?></td>
                </tr>
                <tr>
                    <td>Sistema Operativo:</td>
                    <td><?php echo $producto['Sistema_Operativo']; ?></td>
                </tr>
                <tr>
                    <td>Conectividad:</td>
                    <td><?php echo $producto['Conectividad']; ?></td>
                </tr>
                <tr>
                    <td>Precio:</td>
                    <td>$<?php echo number_format($producto['precio'], 2); ?></td>
                </tr>
            </table>
        </div>
        <a href="../index.php">Volver</a>
    </div>
</body>

</html>