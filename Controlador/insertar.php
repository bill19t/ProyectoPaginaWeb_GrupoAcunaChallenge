<?php
include("../Modelo/conexion.php");
$con = conectar();

if (isset($_POST['guardar'])) {
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $pantalla = $_POST['pantalla'];
    $procesador = $_POST['procesador'];
    $camara = $_POST['camara'];
    $bateria = $_POST['bateria'];
    $so = $_POST['so'];
    $conectividad = $_POST['conectividad'];

    // Manejo de la imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $imagen = $_FILES['imagen']['name'];
        $imagen_temporal = $_FILES['imagen']['tmp_name'];
        $fecha = new DateTime();
        $imagen = $fecha->getTimestamp() . "_" . $imagen;

        $directorio = "../Public/IMG/productos/";
        if (!file_exists($directorio)) {
            mkdir($directorio, 0777, true);
        }

        if (move_uploaded_file($imagen_temporal, $directorio . $imagen)) {
            $ruta_imagen = "IMG/productos/" . $imagen;
        }
    } else {
        $ruta_imagen = "IMG/productos/default.jpg";
    }

    $sql = "INSERT INTO productos (modelo, marca, precio, stock, imagen, Pantalla, Procesador, Camara_Principal, Bateria, Sistema_Operativo, Conectividad) 
            VALUES ('$modelo', '$marca', '$precio', '$stock', '$ruta_imagen', '$pantalla', '$procesador', '$camara', '$bateria', '$so', '$conectividad')";

    $query = mysqli_query($con, $sql);

    if ($query) {
        Header("Location: ../Modelo/tabla.php");
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="../Modelo/style.css">
</head>

<body>
    <div class="form-container">
        <h2>Agregar Nuevo Producto</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" name="modelo" placeholder="Modelo" required>
            <input type="text" name="marca" placeholder="Marca" required>
            <input type="number" name="precio" placeholder="Precio" required step="0.01">
            <input type="number" name="stock" placeholder="Stock" required>
            <input type="text" name="pantalla" placeholder="Pantalla" required>
            <input type="text" name="procesador" placeholder="Procesador" required>
            <input type="text" name="camara" placeholder="Cámara Principal" required>
            <input type="text" name="bateria" placeholder="Batería" required>
            <input type="text" name="so" placeholder="Sistema Operativo" required>
            <input type="text" name="conectividad" placeholder="Conectividad" required>
            <div class="form-group">
                <label for="imagen">Imagen del producto:</label>
                <input type="file" name="imagen" id="imagen" accept="image/*">
                <img id="preview" src="" style="max-width: 200px; display: none; margin-top: 10px;">
            </div>
            <input type="submit" name="guardar" value="Guardar">
        </form>
    </div>

    <script>
        document.getElementById('imagen').onchange = function(e) {
            let reader = new FileReader();
            reader.onload = function(e) {
                let preview = document.getElementById('preview');
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(this.files[0]);
        };
    </script>
</body>

</html>